<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ReadThreadsTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();

        $this->thread = factory('App\Thread')->create();
    }


    /** @test*/
    /*public function a_user_can_browse_threads()
    {
        $thread = factory('App\Thread')->create();

        $response = $this->get('/threads');
        $response->assertSee($thread->title);

        $response = $this->get('/threads/' . $thread->id);
        $response->assertSee($thread->title);
    }*/
    public function a_user_can_view_all_threads()
    {

         $this->get('/threads')
                    ->assertSee($this->thread->title);

    }

   /* @test*/
    public function a_user_can_read_a_single_thread()
    {

         $this->get($this->thread->path())
                    ->assertSee($this->thread->title);
    }
    /*test*/
    public function a_user_can_read_replies_that_are_associated_with_a_thread()
    {
        //And that thread includes replies
        $reply = factory('App\Reply')
            ->create(['thread_id' => $this->thread->id]);
        //When we visit a thread page
        //Then we shoud see the replies.
        $reply->get($this->thread->path())
            ->assertSee($reply->body);

    }
}
