<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateArticleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_update_his_own_article()
    {
        // Given nga naa tay user ug naa syay article
        $user = factory('App\User')->create();

        $this->be($user);

        $article = factory('App\Article')->create([
            'user_id' => $user->id
        ]);

        // When mag update sya sa iya article
        $updatedArticle = [
            'title' => 'Hello World',
            'content' => 'Beki ipsum dolor'
        ];

        $this->patch('/articles/' . $article->id, $updatedArticle);

        // Then dapat na update pud sa database
        tap($article->fresh(), function ($article) {
            $this->assertEquals('Hello World', $article->title);
        });
    }

    /** @test */
    public function a_user_cannot_update_somebody_else_article()
    {
        $user1 = factory('App\User')->create();
        $user2 = factory('App\User')->create();

        $article = factory('App\Article')->create([
            'user_id' => $user1->id
        ]);

        $this->be($user2);

        $response = $this->patch('/articles/' . $article->id, [
            'title' => 'Dili ni ako',
            'content' => 'Beki ipsum dolor.'
        ]);

        $response->assertRedirect('/');
    }
}
