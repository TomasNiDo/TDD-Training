<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ArticleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_article_should_have_an_owner()
    {
        $article = factory('App\Article')->create();

        $this->assertInstanceOf(\App\User::class, $article->user);
    }
}
