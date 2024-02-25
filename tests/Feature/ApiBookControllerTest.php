<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Faker\Factory;
use Faker\Generator;
use Tests\TestCase;
use App\Models\Book;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ApiBookControllerTest extends TestCase
{
    use DatabaseTransactions;
    
    private Generator $faker;
    private $payload;
    
    public function setUp(): void 
    {
        parent::setUp();
        $this->faker = Factory::create();
        $title = $this->faker->sentence(2);
        $id    = $this->faker->numberBetween($min = 1000, $max = 2000);
        $this->payload = [
                'id'            => $id,
                'title'         => rtrim($title, '.'),
                'author'        => $this->faker->words(3, true),
                'count_pages'   => $this->faker->numberBetween($min = 400, $max = 500),
                'price'         => $this->faker->randomFloat('2', 0, 2),
                'description'   => $this->faker->paragraph(1)
            ];
            
    }

    public function test_book_store(): void
    {
        $this->json('post', 'api/book', $this->payload)
             ->assertStatus(Response::HTTP_OK)
             ->assertJsonStructure([
                'book' => 
                    [
                         'title',
                         'author',
                         'count_pages',
                         'price',
                         'description'
                    ]
                ]);
        unset($this->payload['id']);
        $this->assertDatabaseHas('books', $this->payload);
      }


    public function test_book_update(): void
    {
      
        Book::create($this->payload);
        $this->json('put', 'api/book/' . $this->payload['id'], $this->payload)
             ->assertStatus(Response::HTTP_OK)
             ->assertJsonStructure([
                  'book' => 
                    [
                         'title',
                         'author',
                         'count_pages',
                         'price',
                         'description'
                    ]
                ]);

        $this->assertDatabaseHas('books', $this->payload);
      }
}