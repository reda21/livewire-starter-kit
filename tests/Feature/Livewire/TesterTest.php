<?php

namespace Tests\Feature\Livewire;

use App\Livewire\Tester;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class TesterTest extends TestCase
{
    #[Test]
    public function renders_successfully()
    {
        Livewire::test(Tester::class)
            ->assertStatus(200);
    }
}
