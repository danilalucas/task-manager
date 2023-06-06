<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;

class UserTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::create([
            'name'=> 'test',
            'email'=>'test@gmail.com',
            'password'=>Hash::make('12345678')
        ]);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_if_user_is_redirected_to_route_task_index_after_login()
    {
        $response = $this->post(route('login'), [
            'email'=> $this->user->email,
            'password'=> '12345678'
        ]);

        $this->assertAuthenticatedAs($this->user);
        $response->assertRedirect(route('task.index'));
    }

    public function test_if_user_with_invalid_credentials_does_not_login()
    {
        $this->get(route('login'));

        $response = $this->post(route('login'), [
            'email'=> $this->user->email,
            'password'=> 'senha123'
        ]);
        
        $this->assertGuest();
        $response->assertRedirect(route('login'));

        $response->assertSessionHasErrors('email');
    }

    public function test_if_unauthenticated_user_is_redirected_to_login_when_accessing_protected_route()
    {
        $response = $this->get(route('task.index'));

        $response->assertRedirect(route('login'));
        $response->assertStatus(302);
    }

    public function test_if_authenticated_user_accesses_protected_route()
    {
        $response = $this->actingAs($this->user)->get(route('task.index'));
        $response->assertStatus(200);
    }

    public function test_if_user_when_logout_is_redirected_to_the_login_page()
    {
        $response = $this->actingAs($this->user)->post(route('logout'));

        $response->assertRedirect(route('login'));
        $this->assertGuest();
    }

    public function test_if_user_can_generate_the_password_recovery_token()
    {
        $this->get(route('password.request'));

        $response = $this->post(route('password.email'), [
            'email' => $this->user->email,
        ]);

        $response->assertRedirect(route('password.request'));
        $this->assertNotNull($this->user->fresh()->tokens);
        $this->assertDatabaseHas('password_resets', [
            'email' => $this->user->email,
        ]);
    }

    public function test_if_user_can_reset_password_with_valid_token()
    {
        Notification::fake();

        $token = Password::createToken($this->user);

        $response = $this->post(route('password.update'), [
            'token' => $token,
            'email' => $this->user->email,
            'password' => 'novasenha',
            'password_confirmation' => 'novasenha',
        ]);

        $response->assertRedirect(route('task.index'));
        $this->assertCredentials([
            'email' => $this->user->email,
            'password' => 'novasenha',
        ]);
    }

    public function test_if_user_can_update_profile()
    {
        $newName = 'Novo Nome';
        $newEmail = 'novoemail@example.com';

        $this->actingAs($this->user)->get(route('profile.edit'));

        $response = $this->actingAs($this->user)->patch(route('profile.update'), [
            'name' => $newName,
            'email' => $newEmail,
        ]);

        $response->assertRedirect(route('profile.edit'));

        $this->assertDatabaseHas('users', [
            'id' => $this->user->id,
            'name' => $newName,
            'email' => $newEmail,
        ]);
    }

    public function test_if_user_can_update_password_profile()
    {
        $newPassword = 'senha123';

        $this->actingAs($this->user)->get(route('profile.password.edit'));

        $response = $this->actingAs($this->user)->patch(route('profile.password.update'), [
            'password_current' => '12345678',
            'password' => $newPassword,
            'password_confirmation' => $newPassword,
        ]);

        $response->assertRedirect(route('profile.password.edit'));

        $this->assertTrue(Hash::check($newPassword, $this->user->fresh()->password));
    }
}
