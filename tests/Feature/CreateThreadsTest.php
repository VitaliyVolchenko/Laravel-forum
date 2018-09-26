<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateThreadsTest extends TestCase
{
    use DatabaseMigrations;


    /** @test*/
    function guests_may_not_create_threads()
    {
        $this->withExceptionHandling();

        $this->get('/threads/create')
            ->assertRedirect('/login');

        $this->post('/threads')
            ->assertRedirect('/login');
    }

    /** @test*/
    public function an_authenticated_user_can_create_new_forum_threads()
    {
        //Given we have a signed in user
        //$this->actingAs(create('App\User'));
        $this->signIn();

        //When we hit the endpoint to create a new thread
        $thread = create('App\Thread');

        $this->post('/threads', $thread->toArray());

        //Then, when we visit the thread page
        //We should see the new thread
        $this->get($thread->path())
                ->assertSee($thread->title)
                ->assertSee($thread->body);
    }
}
