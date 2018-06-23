<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeleteArticleTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $article;

    public function setUp()
    {
        parent::setUp();

        $this->user = factory('App\User')->create();

        $this->article = factory('App\Article')->create([
            'user_id' => $this->user->id
        ]);
    }

    /** @test */
    public function a_user_can_delete_his_own_article()
    {
        $this->be($this->user);

        $this->delete('/articles/' . $this->article->id);

        $this->assertDatabaseMissing('articles', $this->article->toArray());
    }

    /** @test */
    public function a_user_cannot_delete_somebody_else_article()
    {
        $user = factory('App\User')->create();

        $this->be($user);

        $this->delete('/articles/' . $this->article->id)
            ->assertRedirect('/');

        $this->assertDatabaseHas('articles', $this->article->toArray());
    }
}
