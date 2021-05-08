<?php

namespace Tests\Feature;

use DateTime;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserApiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * User Register Api Test.
     *
     * @return void
     */
    public function testCanRegisterUser()
    {
        $form_data = [
            'name' => 'sohaib',
            'email' => 'sohaib@yahoo.com',
            'password' => 'password',
            'password_confirmation' => 'password'  
        ];

        $this->withExceptionHandling();

        $this->json('POST', route('api.register'), $form_data)
                ->assertStatus(200);
    }

    /**
     * User Login Api Test.
     */
    public function testCanLoginUser()
    {
        $form_data = [
            'email' => 'sohaib@yahoo.com',
            'password' => 'password'
        ];
        $this->json('POST', route('api.login'), $form_data)
                ->assertStatus(200);
    }

}
