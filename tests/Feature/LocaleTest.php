<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LocaleTest extends TestCase
{
    use RefreshDatabase;

    public function test_the_site_stays_in_french_by_default(): void
    {
        $home = 'http://'.config('app.client_domain').'/';

        $this->get($home)
            ->assertOk()
            ->assertSee('Produits')
            ->assertSee('Près de moi')
            ->assertSee('L’univers des stands, près de chez vous.', false)
            ->assertSee('Devenez vendeur sur KELBOM')
            ->assertSee('Français')
            ->assertSee('English')
            ->assertSee('/langue/en', false);
    }

    public function test_english_is_kept_for_the_next_visit(): void
    {
        $base = 'http://'.config('app.client_domain');

        $this->from($base.'/')
            ->get($base.'/langue/en')
            ->assertRedirect($base.'/')
            ->assertSessionHas('locale', 'en');

        $this->get($base.'/')
            ->assertOk()
            ->assertSee('Products')
            ->assertSee('Near me')
            ->assertSee('Search Kelbom')
            ->assertSee('A world of stands, right near you.')
            ->assertSee('Open stands')
            ->assertSee('Can’t find what you need?', false)
            ->assertSee('For sellers')
            ->assertSee('The worldwide marketplace for everyone.')
            ->assertDontSee('L’univers des stands, près de chez vous.');
    }

    public function test_french_keeps_catalog_text_when_only_english_is_translated(): void
    {
        app()->setLocale('fr');

        $this->assertSame('Produits', \App\Support\Localize::line('categories.produits', 'Produits'));
        $this->assertSame('Épices et miel.', \App\Support\Localize::line('stands.saveurs-du-noun', 'Épices et miel.'));

        app()->setLocale('en');

        $this->assertSame('Products', \App\Support\Localize::line('categories.produits', 'Produits'));
        $this->assertSame(
            'Spices, honey and produce from the West region.',
            \App\Support\Localize::line('stands.saveurs-du-noun', 'Épices et miel.')
        );
    }

    public function test_product_and_nearby_pages_follow_the_locale(): void
    {
        $base = 'http://'.config('app.client_domain');

        $this->get($base.'/produits')
            ->assertOk()
            ->assertSee('Tous les Produits')
            ->assertSee('Trouvez ce qu\'il vous faut');

        $this->get($base.'/pres-de-moi')
            ->assertOk()
            ->assertSee('Les stands les plus proches')
            ->assertSee('Utiliser ma position');

        $this->from($base.'/produits')
            ->get($base.'/langue/en')
            ->assertRedirect($base.'/produits')
            ->assertSessionHas('locale', 'en');

        $this->get($base.'/produits')
            ->assertOk()
            ->assertSee('All products')
            ->assertSee('Find what you need')
            ->assertDontSee('Trouvez ce qu\'il vous faut');

        $this->get($base.'/pres-de-moi')
            ->assertOk()
            ->assertSee('The closest stands')
            ->assertSee('Use my location')
            ->assertDontSee('Les stands les plus proches');

        $this->get($base.'/marketplace')->assertOk()->assertSee('Explore the marketplace');
        $this->get($base.'/contact')->assertOk()->assertSee('We are here to help');
        $this->get($base.'/demande')->assertOk()->assertSee('Post your purchase request');
        $this->get($base.'/notre-histoire')->assertOk()->assertSee('Our Story');
    }

    public function test_the_seller_home_follows_the_locale(): void
    {
        $base = 'http://'.config('app.seller_domain');

        $this->get($base.'/')
            ->assertOk()
            ->assertSee('Ouvrir mon stand')
            ->assertSee('Centre d\'aide');

        $this->from($base.'/')
            ->get($base.'/langue/en')
            ->assertRedirect($base.'/')
            ->assertSessionHas('locale', 'en');

        $this->get($base.'/')
            ->assertOk()
            ->assertSee('Open my stand')
            ->assertSee('Help center')
            ->assertDontSee('Ouvrir mon stand');
    }

    public function test_unknown_locale_is_rejected(): void
    {
        $this->get('http://'.config('app.client_domain').'/langue/de')
            ->assertNotFound();
    }
}
