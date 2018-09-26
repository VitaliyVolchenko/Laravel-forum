<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ParticipateInForumTest extends TestCase
{
    use DatabaseMigrations;

    function unauthenticated_users_may_not_add_replies()
    {
        $this->withExceptionHandling()
            ->post('/threads/some-channel/1/replies', [])
            ->assertRedirect('/login');
    }

    /** @test*/
    public function an_authenticated_user_may_participate_in_forum_threads()
    {
        //Given we have a authificated user
        $user = factory('App\User')->create();
        $this->be($user = factory('App\User')->create());

        //And an existing thread
        $thread = factory('App\Thread')->create();

        //When the user adds a reply to the thread
        $reply = factory('App\Reply')->make();
        $this->post($thread->path().'/replies', $reply->toArray());

        //Then theur reply shoud be visible on the page
        $this->get($thread->path())
        ->assertSee($reply->body);
    }

    /**@test
    //ErrorException: Array to string conversion

    function a_reply_requires_a_body()
    {
        $this->withExceptionHandling()->signIn();

        $thread = create('App\Thread');
        $reply = make('App\Reply', ['body' => null]);


        $this->post($thread->path() . '/replies' . $reply->toArray())
            ->assertSessionHasErrors('body');
    }*/

}
