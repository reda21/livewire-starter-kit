<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'admin',
                'display_name' => 'Administrateur',
                'description' => 'Gestion des utilisateurs : Création, modification ou suppression de comptes utilisateurs. Gestion des rôles et permissions : Attribution et modification des rôles, contrôle des accès. Surveillance et audit : Suivi des activités sur le site, gestion des incidents. Maintenance et mises à jour : Veiller à la mise à jour du contenu, des plugins et de la sécurité.',
            ],
            [
                'name' => 'moderator',
                'display_name' => 'Modérateur',
                'description' => 'Gestion des commentaires et interactions : Validation ou suppression des commentaires, gestion des signalements d’abus. Médiation entre utilisateurs : Résolution des conflits et réponses aux questions des utilisateurs. Signalement des contenus inappropriés : Remontée des contenus problématiques à l’administrateur.',
            ],
            [
                'name' => 'redactor',
                'display_name' => 'Rédacteur',
                'description' => 'Mise à jour du contenu : Révision et actualisation régulière des tutoriels pour maintenir leur pertinence. Optimisation SEO : Adaptation des contenus pour un meilleur référencement naturel. Interaction avec la communauté : Répondre aux commentaires, apporter des précisions sur les contenus publiés.',
            ],
            [
                'name' => 'user',
                'display_name' => 'Utilisateur',
                'description' => 'Lecture des tutoriels : Accès aux tutoriels et aux commentaires associés. Commentaires et interactions : Possibilité de commenter les tutoriels et d\'échanger avec la communauté.',
            ],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}

