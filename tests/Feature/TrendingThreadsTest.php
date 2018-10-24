<?php

namespace Tests\Feature;

use App\Trending;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
//use Illuminate\Support\Facades\Redis;

class TrendingThreadsTest extends TestCase
{
    use DatabaseMigrations;

    protected function setUp()
    {
        parent::setUp();

        $this->trending = new Trending();

        $this->trending->reset();
        
    }

    /** @test */
    public function it_increments_a_threads_score_each_time_it_is_read()
    {
        //$this->assertEmpty(Redis::zrevrange('testing_trending_threads', 0, -1));
        $this->assertEmpty($this->trending->get());

        $thread = create('App\Thread');
        
        $this->call('GET', $thread->path());

        //$trending = $this->trending->get();

        //$trending = Redis::zrevrange('testing_trending_threads', 0, -1);

        $this->assertCount(1, $trending = $this->trending->get());
        
        $this->assertEquals($thread->title, $trending[0]->title);
    }
}