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
            
            $this->post(route('register'), [
                'name' => 'vov',
                'email' => 'vov@gmail.com',
                'password' => 'qa123123',
                'password_confirmation' => 'qa123123'
            ]);

            Mail::assertQueued(PleaseConfirmYourEmail::class);
            //Mail::assertSent(PleaseConfirmYourEmail::class);            
        }

        /** @test */
        public function user_can_fully_confirm_their_email_addresses()
        {
            Mail::fake();

            $this->post(route('register'), [
                'name' => 'vov',
                'email' => 'vov@gmail.com',
                'password' => 'qa123123',
                'password_confirmation' => 'qa123123'
            ]);

            $user = User::whereName('vov')->first();

            $this->assertFalse($user->confirmed);
            $this->assertNotNull($user->confirmation_token);

            // Let the user confirm their account.
            $this->get(route('register.confirm', ['token' => $user->confirmation_token]))
                ->assertRedirect(route('threads'));

            tap($user->fresh(), function ($user) {
                $this->assertTrue($user->confirmed);
                $this->assertNull($user->confirmation_token);
            });             
        } 
        
        /** @test */
        public function confirming_an_invalid_token()
        {
            $this->get(route('register.confirm', ['token' => 'invalid']))
                ->assertRedirect(route('threads'))
                ->assertSessionHas('flash', 'Unknown token.');
        }
}