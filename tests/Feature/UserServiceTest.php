<?php

namespace Tests\Feature;

use App\Service\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_POST_LOGIN()
    {
        $service = new UserService();

        $request = new Request([
            'email' => 'user@gmail.com',
            'password' => '123456',
            'remember' => 'on'
        ]);

        $response = $service->loginService($request);
        self::assertTrue($response);

    }
}
