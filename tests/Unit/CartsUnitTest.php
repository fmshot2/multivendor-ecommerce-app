<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class CartsUnitTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $category = \App\Models\Category::create(
            [
                'title'=>"word",
                'slug'=>"word-slug",
                'summary'=>"word-slug",
                'photo'=>"word-slug",
                'is_parent'=>true,
                'status'=>'active',
                'parent_id'=>1,
            ]
        );
        dd($category);
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertDontSee("no items in cart");
        $response->assertViewHas("categories", function ($collection) use ($category) {
            return $collection->contains($category);
        });
    }
}
