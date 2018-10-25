<?php

namespace Tests\Feature;

use Illuminate\Auth\Events\Registered;
use App\Mail\PleaseConfirmYourEmail;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use DatabaseMigrations;

        /** @test */
        public function a_confirmation_email_is_sent_upon_registration()
        {
            Mail::fake();

            event(new Registered(create('App\User')));

            Mail::assertSent(PleaseConfirmYourEmail::class);            
        }

        /** @test */
        public function user_can_fully_confirm_their_email_addresses()
        {
            $this->post('/register', [
                'name' => 'vov',
                'email' => 'vov@gmail.com',
                'password' => 'qa123123',
                'password_confirmation' => 'qa123123'
            ]);

            $user = User::whereName('vov')->first();

            $this->assertFalse($user->confirmed);
            $this->assertNotNull($user->confirmation_token);

            // Let the user confirm their account.
            $response = $this->get('/register/confirm?token=' . $user->confirmation_token);
            
            $this->assertTrue($user->fresh()->confirmed);

            $response->assertRedirect('/threads')
                ->with('flash', 'Your account is now confirmed! You may post to the forum.');
        }        
}