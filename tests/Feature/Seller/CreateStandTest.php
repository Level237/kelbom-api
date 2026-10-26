<?php

namespace Tests\Feature\Seller;

use App\Models\Category;
use App\Models\User;
use Database\Seeders\RoleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class CreateStandTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(RoleSeeder::class);
    }

    private function sellerDomainUrl(string $path): string
    {
        return 'http://'.config('app.seller_domain').$path;
    }

    public function test_guest_can_open_public_create_page(): void
    {
        $response = $this->get($this->sellerDomainUrl('/create'));

        $response->assertOk();
    }

    public function test_guest_can_register_and_create_stand_via_public_form(): void
    {
        $category = Category::create([
            'name' => 'Artisanat',
            'slug' => 'artisanat',
            'is_active' => true,
        ]);

        $response = $this->post($this->sellerDomainUrl('/create'), [
            'name' => 'Kofi Mensah',
            'stand_name' => 'Stand Kofi',
            'kind' => 'product',
            'category_id' => $category->id,
            'country' => 'Ghana',
            'city' => 'Accra',
            'phone_number' => '+233201234567',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertRedirect(route('seller.loading-stand'));
        $this->assertAuthenticated();
        $this->assertDatabaseHas('users', ['phone_number' => '+233201234567']);
        $this->assertDatabaseHas('stands', ['stand_name' => 'Stand Kofi']);
    }

    public function test_authenticated_seller_can_create_stand_in_one_step(): void
    {
        $user = User::factory()->create([
            'name' => 'Aminata K.',
            'phone_number' => '+22890123456',
            'password' => Hash::make('password'),
        ]);
        $user->assignRole('seller');

        $category = Category::create([
            'name' => 'Mode',
            'slug' => 'mode',
            'is_active' => true,
        ]);

        $response = $this->actingAs($user)->post($this->sellerDomainUrl('/create'), [
            'name' => 'Aminata K.',
            'stand_name' => 'Boutique Aminata',
            'kind' => 'product',
            'category_id' => $category->id,
            'country' => 'Togo',
            'city' => 'Lomé',
            'phone_number' => '+22890123456',
            'email' => 'aminata@example.com',
        ]);

        $response->assertRedirect(route('seller.loading-stand'));

        $this->assertDatabaseHas('stands', [
            'user_id' => $user->id,
            'stand_name' => 'Boutique Aminata',
            'kind' => 'product',
            'city' => 'Lomé',
            'country' => 'Togo',
            'contact_phone' => '+22890123456',
        ]);

        $stand = $user->fresh()->stand;
        $this->assertNotNull($stand);
        $this->assertTrue($stand->categories->contains($category));
        $this->assertNotNull($stand->buyleadCredits);
    }

    public function test_seller_with_stand_cannot_access_create_form(): void
    {
        $user = User::factory()->create([
            'phone_number' => '+22890123457',
            'password' => Hash::make('password'),
        ]);
        $user->assignRole('seller');

        Category::create(['name' => 'Food', 'slug' => 'food', 'is_active' => true]);

        $user->stand()->create([
            'stand_name' => 'Existing',
            'slug' => 'existing-1',
            'city' => 'Lomé',
            'country' => 'Togo',
            'contact_phone' => '+22890123457',
        ]);

        $response = $this->actingAs($user)->get($this->sellerDomainUrl('/create'));

        $response->assertRedirect(route('seller.dashboard'));
    }
}
