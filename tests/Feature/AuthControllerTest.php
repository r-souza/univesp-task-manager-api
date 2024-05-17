<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

/**
 * Class AuthControllerTest
 * @group now
 * @package Tests\Feature
 */
class AuthControllerTest extends TestCase
{
    use DatabaseTransactions;
    use WithFaker;

    /**
     * Test a successful login request
     *
     * @return void
     */
    public function testLoginSuccess()
    {
        $user = User::factory()->create();

        $response = $this->postJson('/api/auth/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'access_token',
                'token_type',
                'expiration',
            ]);
    }

    /**
     * Test a failed login request
     *
     * @return void
     */
    public function testLoginFailure()
    {
        $response = $this->postJson('/api/auth/login', [
            'email' => $this->faker->safeEmail,
            'password' => $this->faker->password,
        ]);

        $response->assertStatus(Response::HTTP_UNAUTHORIZED)
            ->assertJson([
                'error' => 'Credenciais fornecidas são inválidas',
            ]);
    }

    /**
     * Test a successful logout request
     *
     * @return void
     */
    public function testLogoutSuccess()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        $response = $this->getJson('/api/auth/logout');

        $response->assertStatus(Response::HTTP_OK)
            ->assertJson([
                'message' => 'Logout realizado com sucesso!',
            ]);
    }

    /**
     * Test a successful me request
     *
     * @return void
     */
    public function testMeSuccess()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        $response = $this->getJson('/api/me');

        $response->assertStatus(Response::HTTP_OK)
            ->assertJson([
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ]);
    }

    /**
     * Test a successful refresh request
     *
     * @return void
     */
    public function testRefreshSuccess()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        $response = $this->getJson('/api/auth/refresh');

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'access_token',
                'token_type',
                'expiration',
            ]);
    }
}
