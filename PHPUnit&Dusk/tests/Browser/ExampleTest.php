<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class ExampleTest extends DuskTestCase
{

    public function testBasicExample()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->assertSee('REGISTER')
                ->clickLink('Register')
                ->type('name', 'Admin User')
                ->type('email', 'admin@teste.com')
                ->type('password', '12345678')
                ->type('password_confirmation', '12345678')
                ->press('Register');
        });

        $this->assertDatabaseHas('users', ['name' => 'Admin User']);
    }
}
