<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class PageTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->type('@new-domain','chess.com')
                    ->keys('@new-domain',['{enter}'])
                    ->assertSeeIn('@vue-contains-test',"chess.com")
                    ->assertVisible('@vue-search-btn');
        });
    }
}
