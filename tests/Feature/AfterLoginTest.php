<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AfterLoginTest extends TestCase
{
    use DatabaseTransactions;

    protected $user;
    protected $email;
    protected $password;

    public function setUp(): void
    {
        parent::setUp();

        $this->email    = 'test@admin.bg';
        $this->password = 'Test2024';
        $this->user = User::factory()->create([
            'email'    => $this->email,
            'password' => bcrypt($this->password)
        ]);
    }

    public function test_successful_redirection_after_login(): void
    {
        $response = $this
            ->from('/login')->post('/login',
            [
                'email' => $this->user->email,
                'password' => $this->password
            ]);
        $response->assertRedirect('/books');
    }

    public function test_not_successful_redirection_after_login(): void
    {
        $response = $this
            ->from('/login')->post('/login',
            [
                'email' => 'test1@admin.bg',
                'password' => $this->password
            ]);

        $this->assertNotSame('/books', Route::current());
    }
}
