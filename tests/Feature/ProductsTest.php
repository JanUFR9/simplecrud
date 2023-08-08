<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\product;
use Illuminate\Support\Facades\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductsTest extends TestCase
{
    public function testHomepageContainsEmptyProductsTable()
    {
        $response = $this->withoutMiddleware()->get('/home');
        $response->assertSee(__('No Items!'));
    }
    
    use WithFaker;

    public function testHomepageContainsNonEmptyProductsTable()
    {
        $user = User::factory()->create();

        
        $productData = [
            'pname' => $this->faker->word,
            'amount' => $this->faker->numberBetween(1, 100),
            'price' => $this->faker->randomFloat(2, 10, 1000),
        ];

        
        $this->actingAs($user);

       
        $response = $this->withoutMiddleware()->post('/product', $productData);

        $response = $this->get('/home');

       
        $response->assertSee($productData['pname']);
        $response->assertSee($productData['amount']);
        $response->assertSee($productData['price']);

        //$response = $this->withoutMiddleware()->get('/product/create');
       // $response->header('Product test', 'pname')->header(1, 'amount')->header(1, 'price')->press('Submit')->press('Go Back');
        //$response->assertDontSee('No Items!');
    }
}
