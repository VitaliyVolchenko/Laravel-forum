<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class MentionUsersTest extends TestCase
{
    use DatabaseMigrations;
    
    /** @test */
    public function mentioned_users_in_a_reply_are_notified()
    {
        // Given I have a user, Vital, who is signed in.
        $vital = create('App\User', ['name' => 'vital']);

        $this->signIn($vital);

        // And Another use, Vital.
        $vital = create('App\User', ['name' => 'vital']);

        // if we have a thread
        $thread = create('App\Thread');
        // And Vital replies and mentions @Vital
        $reply = make('App\Reply',[
            'body' => '@vital look at this.'
        ]);

        $this->json('post', $thread->path() . '/replies', $reply->toArray());

        // Than Vital should be notified.
        $this->assertCount(1, $vital->notifications);
    }

     /** @test */
     function it_can_fetch_all_mentioned_users_starting_with_the_given_characters()
     {
         create('App\User', ['name' => 'vital']);
         create('App\User', ['name' => 'vital2']);
         create('App\User', ['name' => 'votal']);

         $results = $this->json('GET', '/api/users', ['name' => 'vital']);

         $this->assertCount(2, $results->json());
     }
}
