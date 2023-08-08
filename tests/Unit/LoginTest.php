<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{

    use RefreshDatabase;


    public function testNewUserLogin()
    {
        
        $response = $this->post('/login', [
            'email' => 'testbot1@botmail.com',
            'password' => 'Testbot123',
        ]);

        $response->assertRedirect('/home');
    }
}
