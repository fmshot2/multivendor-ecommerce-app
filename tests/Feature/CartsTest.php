<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CartsTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    // public function test_cartpage_contains__empty_table()
    // {
    //     $response = $this->get('/cart');

    //     $response->assertStatus(200);
    //     $response->assertSee("no items in cart");
    // }

    public function test_cartpage_contains_non_empty_table()
    {
        $response = $this->get('/cart');

        $response->assertStatus(200);
        $response->assertSee("no items in cart");
        // $response->assertViewHas("no items in cart");
    }
}
