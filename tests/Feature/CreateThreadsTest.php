<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class CreateThreadsTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function guests_cannot_create_forum_threads()
    {
        $this->expectException('Illuminate\Auth\AuthenticationException');

        $this->post(route('threads.index'), []);
    }

    /** @test */
    public function guests_cannot_see_the_thread_create_page()
    {
        $this->withExceptionHandling()
            ->get(route('threads.create'))
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function an_authenticated_user_can_create_forum_threads()
    {
        $this->actingAs(create('App\User'));

        $thread = make('App\Thread');

        $this->post('/threads', $thread->toArray());

        $this->get($thread->path())
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }
}
