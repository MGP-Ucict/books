<?php

namespace Tests\Feature;

use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Faker\Factory;
use Faker\Generator;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BookControllerTest extends TestCase
{
    use DatabaseTransactions;
    
    private Generator $faker;
    private Book $book;
    private $payload;
    
    public function setUp(): void 
    {
        parent::setUp();
        $this->faker = Factory::create();
        $title = $this->faker->sentence(2);
        $this->payload = [
                'title'         => rtrim($title, '.'),
                'author'        => $this->faker->words(3, true),
                'count_pages'   => $this->faker->numberBetween($min = 400, $max = 500),
                'price'         => $this->faker->randomFloat('2', 0, 2),
                'description'   => $this->faker->paragraph(1)
            ];

        $this->book = Book::create($this->payload);
    }

    public function test_book_show(): void
    {
       
        $view = $this->view('books.show', ['book' => $this->book]);
 
        $view->assertSee($this->payload['title']);
        $view->assertSee($this->payload['author']);
    }

    public function test_book_index(): void
    {
    
        $view = $this->view('books.index',  ['books' => Book::query()->paginate(10)]);
 
        $view->assertSee('Search');
    }
}