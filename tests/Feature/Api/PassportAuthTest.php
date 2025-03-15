<?php

namespace Tests\Feature\Passport;

use App\Models\User;
use Laravel\Passport\Client;
use Laravel\Passport\Passport;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;

class PassportAuthTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $passwordClient;
    protected $personalAccessClient;

    protected function setUp(): void
{
    parent::setUp();

    // Charger les clés OAuth depuis un dossier 'tests/keys'
    // (Assurez-vous que ces fichiers existent et contiennent des clés valides pour vos tests)
    Passport::loadKeysFrom(base_path('tests/keys'));

    // Créer un utilisateur de test
    $this->user = User::factory()->create([
        'email'    => 'test@example.com',
        'password' => bcrypt('password'),
    ]);

    // Créer un client pour le flow Password Grant
    $this->passwordClient = Client::factory()->create([
        'user_id'                => null,
        'name'                   => 'Test Password Client',
        'secret'                 => 'secret',
        'provider'               => 'users',
        'redirect'               => 'http://localhost',
        'personal_access_client' => false,
        'password_client'        => true,
        'revoked'                => false,
    ]);

    // Créer un client pour les Personal Access Tokens
    $this->personalAccessClient = Client::factory()->create([
        'user_id'                => null,
        'name'                   => 'Test Personal Access Client',
        'secret'                 => 'secret',
        'provider'               => 'users',
        'redirect'               => 'http://localhost',
        'personal_access_client' => true,
        'password_client'        => false,
        'revoked'                => false,
    ]);

    // Configurer le client d'accès personnel dans la table oauth_personal_access_clients
    DB::table('oauth_personal_access_clients')->insert([
        'client_id'  => $this->personalAccessClient->id,
        'created_at' => now(),
        'updated_at' => now(),
    ]);
}


    /**
     * Test pour obtenir un token avec Password Grant
     */
    public function test_can_get_access_token_with_password_grant()
    {
        $response = $this->postJson('/oauth/token', [
            'grant_type'    => 'password',
            'client_id'     => $this->passwordClient->id,
            'client_secret' => 'secret',
            'username'      => 'test@example.com',
            'password'      => 'password',
            'scope'         => '',
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'token_type',
            'expires_in',
            'access_token',
            'refresh_token',
        ]);
    }

    /**
     * Test pour échouer l'obtention d'un token avec des identifiants invalides
     */
    public function test_cannot_get_token_with_invalid_credentials()
    {
        $response = $this->postJson('/oauth/token', [
            'grant_type'    => 'password',
            'client_id'     => $this->passwordClient->id,
            'client_secret' => 'secret',
            'username'      => 'test@example.com',
            'password'      => 'wrong-password',
            'scope'         => '',
        ]);

        $response->assertStatus(401);
        $response->assertJsonStructure(['error', 'message']);
    }

    /**
     * Test pour rafraîchir un token
     */
    public function test_can_refresh_token()
    {
        // Obtenir d'abord un token
        $tokenResponse = $this->postJson('/oauth/token', [
            'grant_type'    => 'password',
            'client_id'     => $this->passwordClient->id,
            'client_secret' => 'secret',
            'username'      => 'test@example.com',
            'password'      => 'password',
            'scope'         => '',
        ]);

        $tokenData   = $tokenResponse->json();
        $refreshToken = $tokenData['refresh_token'];

        // Rafraîchir le token avec le refresh_token obtenu
        $response = $this->postJson('/oauth/token', [
            'grant_type'    => 'refresh_token',
            'refresh_token' => $refreshToken,
            'client_id'     => $this->passwordClient->id,
            'client_secret' => 'secret',
            'scope'         => '',
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'token_type',
            'expires_in',
            'access_token',
            'refresh_token',
        ]);
    }

    /**
     * Test pour créer un personal access token
     */
    public function test_can_create_personal_access_token()
    {
        Passport::actingAs($this->user);

        $response = $this->postJson('/oauth/personal-access-tokens', [
            'name'   => 'Test Token',
            'scopes' => ['*'],
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure(['accessToken', 'token']);
    }

    /**
     * Test pour lister les personal access tokens
     */
    public function test_can_list_personal_access_tokens()
    {
        Passport::actingAs($this->user);

        // Créer un token au préalable
        $this->postJson('/oauth/personal-access-tokens', [
            'name'   => 'Test Token',
            'scopes' => ['*'],
        ]);

        $response = $this->getJson('/oauth/personal-access-tokens');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            '*' => [
                'id',
                'name',
                'scopes',
                'revoked',
                'created_at',
                'updated_at',
                'expires_at',
            ]
        ]);
    }

    /**
     * Test pour révoquer un personal access token
     */
    public function test_can_revoke_personal_access_token()
    {
        Passport::actingAs($this->user);

        // Créer un token d'abord
        $tokenResponse = $this->postJson('/oauth/personal-access-tokens', [
            'name'   => 'Test Token',
            'scopes' => ['*'],
        ]);

        $tokenData = $tokenResponse->json();
        $tokenId   = $tokenData['id'];

        // Révoquer le token
        $response = $this->deleteJson('/oauth/personal-access-tokens/' . $tokenId);

        $response->assertStatus(204);

        // Vérifier que le token n'est plus listé
        $listResponse = $this->getJson('/oauth/personal-access-tokens');
        $tokens       = $listResponse->json();

        $this->assertEmpty($tokens);
    }
}
