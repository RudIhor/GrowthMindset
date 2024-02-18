<?php

namespace Modules\Category\tests;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Validation\ValidationException;
use Modules\Category\database\factories\CategoryFactory;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    private User $user;
    private Collection $categories;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->categories = CategoryFactory::new()->count(10)->create();
    }

    #[Test]
    public function it_should_return_categories()
    {
        $result = $this->actingAs($this->user)->get('/api/categories');

        $result->assertOk();
        $result->assertJsonCount(3);
        $result->assertJsonCount(10, 'data');
    }

    #[Test]
    public function it_should_return_a_category()
    {
        $result = $this->actingAs($this->user)->get('/api/categories/1');

        $result->assertOk();
        $result->assertJsonStructure(['id', 'name']);
    }

    #[Test]
    public function it_should_create_a_category()
    {
        $data = [
            'name' => 'Dogs',
        ];
        $this->actingAs($this->user)->post('/api/categories', $data);

        $this->assertDatabaseCount('categories', 11);
    }

    #[Test]
    public function it_should_not_create_a_category_because_of_validation_errors()
    {
        $this->expectException(ValidationException::class);
        $data = [
            'name' => 'J',
        ];
        $this->withoutExceptionHandling()->actingAs($this->user)->post('/api/categories', $data);

        $this->assertDatabaseCount('categories', 10);
    }

    #[Test]
    public function it_should_update_a_category()
    {
        $result = $this->actingAs($this->user)->put('/api/categories/1', [
            'name' => 'Cats',
        ]);

        $this->assertDatabaseCount('categories', 10);
        $result->assertJsonStructure(['id', 'name']);
        $result->assertOk();
    }

    #[Test]
    public function it_should_not_update_category_because_of_validation_errors()
    {
        $this->expectException(ValidationException::class);
        $result = $this->withoutExceptionHandling()->actingAs($this->user)->put('/api/categories/1', [
            'name' => '',
        ]);

        $result->assertUnprocessable();
    }

    #[Test]
    public function it_should_delete_category()
    {
        $result = $this->actingAs($this->user)->delete('/api/categories/1');

        $result->assertNoContent();
        $this->assertDatabaseCount('categories', 9);
    }
}
