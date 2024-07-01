<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Tests\TestCase;

class PostControllerTest extends TestCase
{

    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->actingAs($this->user);
    }

    public function it_displays_the_posts_index_page()
    {
        $response = $this->get(route('posts.index'));

        $response->assertStatus(200);
        $response->assertViewIs('user.posts.index');
    }

    public function it_displays_the_create_post_form()
    {
        $response = $this->get(route('posts.create'));

        $response->assertStatus(200);
        $response->assertViewIs('user.posts.create');
    }

    public function it_stores_a_new_post_with_image()
    {
        Storage::fake('public');

        $file = UploadedFile::fake()->image('test_image.jpg');

        $postData = [
            'title' => 'Test Post',
            'body' => 'This is a test post body.',
            'image' => $file,
        ];

        $response = $this->post(route('posts.store'), $postData);

        $response->assertRedirect(route('posts.index'));
        $this->assertDatabaseHas('posts', [
            'title' => 'Test Post',
            'body' => 'This is a test post body.',
        ]);

        Storage::disk('public')->assertExists('uploads/posts/' . $file->hashName());
    }


    public function it_displays_the_post_details()
    {
        $file = UploadedFile::fake()->image('test_image.jpg');

        $user = User::factory()->create();

        $slug = Str::slug('Test Post');

        $post = Post::factory()->create([
            'title' => 'Test Post',
            'body' => 'This is a test post body.',
            'image' => $file,
            'user_id' => $user->id,
            'slug' => $slug,
        ]);

        $response = $this->get(route('posts.show', $post));

        $response->assertStatus(200);

        $response->assertViewIs('user.posts.show');

        $response->assertViewHas('post', $post);
    }


    public function it_displays_the_edit_post_form()
    {
        $post = Post::factory()->create(['user_id' => $this->user->id]);

        $response = $this->get(route('posts.edit', $post));

        $response->assertStatus(200);

        $response->assertViewIs('user.posts.edit');

        $response->assertViewHas('post', $post);
    }

    public function it_updates_the_post()
    {
        $post = Post::factory()->create(['user_id' => $this->user->id]);
        $updatedData = [
            'title' => 'Updated Title',
            'body' => 'Updated body text.',
        ];

        $response = $this->put(route('posts.update', $post), $updatedData);

        $response->assertRedirect(route('posts.index'));
        $this->assertDatabaseHas('posts', $updatedData);
    }

    public function it_deletes_the_post()
    {
        $post = Post::factory()->create(['user_id' => $this->user->id]);

        $response = $this->delete(route('posts.destroy', $post));

        $response->assertRedirect(route('posts.index'));
        $this->assertDatabaseMissing('posts', ['id' => $post->id]);
    }

}
