<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_BasicTest()
    {
        $response = $this->get('/');

        $foo = 'bar';
        $fla = 'mark';

        $response->assertStatus(200);
    }

    // public function test_it_loads_the_about_page()
    // {
    //     $this->get('/about')->assertSee('joy');
    // }
}
