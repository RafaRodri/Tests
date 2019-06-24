<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testOlaMundo()
    {
        $response = $this->get('/ola');

        $response->assertSee('Olá mundo!');
    }

    public function testPostRoute()
    {
        $this->post('/post', [
            'name' => 'Rafael',
            'email' => 'rafa@teste.com'
        ])
            ->assertStatus(200)
            ->assertJson([
                'name' => 'Rafael',
                'email' => 'rafa@teste.com'
            ]);
    }
}
