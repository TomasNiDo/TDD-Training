<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateArticleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_see_the_create_page()
    {
        $user = factory('App\User')->create();

        $this->get('/articles/create')
            ->assertSee('Create Article');
    }

    /** @test */
    public function a_user_can_post_an_article()
    {
        // Given nga naa tay user ug nag create sya ug article
        $user = factory('App\User')->create();

        $this->be($user);

        $article = factory('App\Article')->make([
            'user_id' => $user->id
        ]);

        // When we submet the article
        $response = $this->post('/articles', $article->toArray());

        // Then ddpat naa sya sa database makita
        $this->assertDatabaseHas('articles', $article->toArray());
    }

    /** @test */
    public function a_user_cannot_post_an_article_without_title_and_content()
    {
        $user = factory('App\User')->create();

        $this->be($user);

        $response = $this->post('/articles');

        $response->assertSessionHasErrors(['title', 'content']);
    }
}
