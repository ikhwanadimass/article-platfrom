<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ChronicleFeaturesTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_page_loads_and_only_shows_published_articles(): void
    {
        $user = User::factory()->create();
        $category = Category::create(['name' => 'Tech', 'slug' => 'tech']);

        $published = Article::create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'title' => 'Published Article',
            'slug' => 'published-article',
            'content' => 'Content here',
            'status' => 'published',
            'published_at' => now(),
        ]);

        $draft = Article::create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'title' => 'Draft Article',
            'slug' => 'draft-article',
            'content' => 'Draft content here',
            'status' => 'draft',
            'published_at' => null,
        ]);

        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Published Article');
        $response->assertDontSee('Draft Article');
    }

    public function test_search_can_find_articles_by_author_name(): void
    {
        $user = User::factory()->create(['name' => 'Sophia Chen']);
        $category = Category::create(['name' => 'Tech', 'slug' => 'tech']);

        Article::create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'title' => 'Unique Modern Designs',
            'slug' => 'unique-designs',
            'content' => 'Content',
            'status' => 'published',
            'published_at' => now(),
        ]);

        $response = $this->get('/search?q=Sophia');
        $response->assertStatus(200);
        $response->assertSee('Unique Modern Designs');
        $response->assertDontSee('Explore Articles');
    }

    public function test_author_profile_page_displays_bio_and_articles(): void
    {
        $user = User::factory()->create([
            'name' => 'Anna Vance',
            'bio' => 'Chief Editor focused on design ergonomics.',
        ]);
        $category = Category::create(['name' => 'Tech', 'slug' => 'tech']);

        Article::create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'title' => 'Design Insights Daily',
            'slug' => 'design-insights-daily',
            'content' => 'Content',
            'status' => 'published',
            'published_at' => now(),
        ]);

        $response = $this->get('/author/'.$user->id);
        $response->assertStatus(200);
        $response->assertSee('Anna Vance');
        $response->assertSee('Chief Editor focused on design ergonomics.');
        $response->assertSee('Design Insights Daily');
    }
}
