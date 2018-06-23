<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReadArticlesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function homepage_has_articles()
    {
        $article = factory('App\Article')->create();

        $this->get('/')
            ->assertSee($article->title);
    }

    /** @test */
    public function an_article_has_its_own_single_page()
    {
        $article = factory('App\Article')->create();

        $this->get('/articles/' . $article->id)
            ->assertSee($article->title);
    }
}
