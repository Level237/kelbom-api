<?php

namespace Tests\Feature\Seller;

use App\Models\User;
use Database\Seeders\RoleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class SellerStandMiddlewareTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(RoleSeeder::class);
    }

    private function sellerUrl(string $path): string
    {
        return 'http://'.config('app.seller_domain').$path;
    }

    public function test_dashboard_redirects_to_stand_create_without_stand(): void
    {
        $user = User::factory()->create([
            'phone_number' => '+22890123458',
            'password' => Hash::make('password'),
        ]);
        $user->assignRole('seller');

        $response = $this->actingAs($user)->get($this->sellerUrl('/dashboard'));

        $response->assertRedirect(route('seller.create'));
    }

    public function test_stand_create_redirects_to_dashboard_when_stand_exists(): void
    {
        $user = User::factory()->create([
            'phone_number' => '+22890123459',
            'password' => Hash::make('password'),
        ]);
        $user->assignRole('seller');
        $user->stand()->create([
            'stand_name' => 'Déjà là',
            'slug' => 'deja-la',
            'city' => 'Lomé',
            'country' => 'Togo',
            'contact_phone' => '+22890123459',
        ]);

        $response = $this->actingAs($user)->get($this->sellerUrl('/stand/create'));

        $response->assertRedirect(route('seller.dashboard'));
    }
}
