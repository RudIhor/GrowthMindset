<?php

namespace Modules\Quote\tests;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Modules\Quote\database\factories\QuoteFactory;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class QuoteTest extends TestCase
{
    use RefreshDatabase;

    private User $user;
    private Collection $quotes;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->quotes = QuoteFactory::new()->count(10)->create();
    }

    #[Test]
    public function it_should_return_quotes()
    {
        $result = $this->actingAs($this->user)->get('/api/quotes');

        $result->assertOk();
        $result->assertJsonCount(3);
        $result->assertJsonCount(10, 'data');
    }

    #[Test]
    public function it_should_return_a_quote()
    {
        $result = $this->actingAs($this->user)->get('/api/quotes/1');

        $result->assertOk();
        $result->assertJsonStructure(['id', 'content', 'author_id', 'category_id']);
    }

    #[Test]
    public function it_should_create_a_category()
    {
        $data = [
            'content' => 'No effect without effort. Work hard and everything will become easier',
            'author_id' => 1,
            'category_id' => 1,
        ];
        $this->actingAs($this->user)->post('/api/quotes', $data);

        $this->assertDatabaseCount('quotes', 11);
    }

    #[Test]
    public function it_should_not_create_a_quote_because_of_validation_errors()
    {
        $this->expectException(ValidationException::class);
        $data = [
            'content' => 'No effect without effort. Work hard and everything will become easier',
            'author_id' => 10_000,
            'category_id' => 10_000,
        ];
        $this->withoutExceptionHandling()->actingAs($this->user)->post('/api/quotes', $data);

        $this->assertDatabaseCount('quotes', 10);
    }

    #[Test]
    public function it_should_update_a_quote()
    {
        $result = $this->actingAs($this->user)->put('/api/quotes/1', [
            'content' => Str::random(),
        ]);

        $this->assertDatabaseCount('quotes', 10);
        $result->assertJsonStructure(['id', 'content', 'author_id', 'category_id']);
        $result->assertOk();
    }

    #[Test]
    public function it_should_not_update_category_because_of_validation_errors()
    {
        $this->expectException(ValidationException::class);
        $result = $this->withoutExceptionHandling()->actingAs($this->user)->put('/api/quotes/1', [
            'content' => '',
        ]);

        $result->assertUnprocessable();
    }

    #[Test]
    public function it_should_delete_category()
    {
        $result = $this->actingAs($this->user)->delete('/api/quotes/1');

        $result->assertNoContent();
        $this->assertDatabaseCount('quotes', 9);
    }
}
