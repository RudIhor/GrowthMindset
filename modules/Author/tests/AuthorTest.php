<?php

namespace Modules\Author\tests;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Validation\ValidationException;
use Modules\Author\database\factories\AuthorFactory;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class AuthorTest extends TestCase
{
    use RefreshDatabase;

    private User $user;
    private Collection $authors;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->authors = AuthorFactory::new()->count(10)->create();
    }

    #[Test]
    public function it_should_return_authors()
    {
        $result = $this->actingAs($this->user)->get('/api/authors');

        $result->assertOk();
        $result->assertJsonCount(3);
        $result->assertJsonCount(10, 'data');
    }

    #[Test]
    public function it_should_return_an_author()
    {
        $result = $this->actingAs($this->user)->get('/api/authors/1');

        $result->assertOk();
        $result->assertJsonStructure(['id', 'first_name', 'last_name']);
    }

    #[Test]
    public function it_should_create_an_author()
    {
        $data = [
            'first_name' => 'John',
            'last_name' => 'Doe',
        ];
        $this->actingAs($this->user)->post('/api/authors', $data);

        $this->assertDatabaseCount('authors', 11);
    }

    #[Test]
    public function it_should_not_create_an_author_because_of_validation_errors()
    {
        $this->expectException(ValidationException::class);
        $data = [
            'first_name' => 'Joe',
            'last_name' => 'D',
        ];
        $this->withoutExceptionHandling()->actingAs($this->user)->post('/api/authors', $data);

        $this->assertDatabaseCount('authors', 10);
    }

    #[Test]
    public function it_should_update_an_author()
    {
        $result = $this->actingAs($this->user)->put('/api/authors/1', [
            'first_name' => 'John',
            'last_name' => 'Doe',
        ]);

        $this->assertDatabaseCount('authors', 10);
        $result->assertJsonStructure(['id', 'first_name', 'last_name']);
        $result->assertOk();
    }

    #[Test]
    public function it_should_not_update_author_because_of_validation_errors()
    {
        $this->expectException(ValidationException::class);
        $result = $this->withoutExceptionHandling()->actingAs($this->user)->put('/api/authors/1', [
            'first_name' => '',
            'last_name' => '',
        ]);

        $result->assertUnprocessable();
    }

    #[Test]
    public function it_should_delete_an_author()
    {
        $result = $this->actingAs($this->user)->delete('/api/authors/1');

        $result->assertNoContent();
        $this->assertDatabaseCount('authors', 9);
    }
}
