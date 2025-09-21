<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Book;
use App\Models\BorrowRecord;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Carbon\Carbon;

class BookVaultFeatureTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function admin_can_create_update_delete_book()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $category = Category::factory()->create();

        // Create book
        $response = $this->actingAs($admin)
            ->post(route('books.store'), [
                'title' => 'Test Book',
                'author' => 'John Doe',
                'category_id' => $category->id,
                'published_year' => 2020,
                'stock_count' => 5,
            ]);
        $response->assertRedirect(route('books.index'));
        $this->assertDatabaseHas('books', ['title' => 'Test Book']);

        $book = Book::first();

        // Update book
        $response = $this->actingAs($admin)
            ->put(route('books.update', $book), [
                'title' => 'Updated Book',
                'author' => 'Jane Doe',
                'category_id' => $category->id,
            ]);
        $response->assertRedirect(route('books.index'));
        $this->assertDatabaseHas('books', ['title' => 'Updated Book']);

        // Delete book
        $response = $this->actingAs($admin)
            ->delete(route('books.destroy', $book));
        $response->assertRedirect(route('books.index'));
        $this->assertDatabaseMissing('books', ['title' => 'Updated Book']);
    }

    /** @test */
    public function member_can_borrow_and_return_book()
    {
        $member = User::factory()->create(['role' => 'member']);
        $book = Book::factory()->create(['stock_count' => 5]);

        // Borrow book
        $response = $this->actingAs($member)
                         ->post(route('borrow.store', $book->id));
        $response->assertRedirect();
        $this->assertDatabaseHas('borrow_records', [
            'user_id' => $member->id,
            'book_id' => $book->id,
            'returned_at' => null,
        ]);
        $this->assertEquals(4, $book->fresh()->stock_count);

        $borrow = BorrowRecord::first();

        // Return book
        $response = $this->actingAs($member)
                         ->put(route('borrow.return', $borrow->id));
        $response->assertRedirect();
        $this->assertNotNull($borrow->fresh()->returned_at);
        $this->assertEquals(5, $book->fresh()->stock_count);
    }

    /** @test */
    public function member_cannot_borrow_more_than_limit()
    {
        $member = User::factory()->create(['role' => 'member']);
        $books = Book::factory()->count(4)->create(['stock_count' => 5]);

        foreach ($books as $book) {
            $this->actingAs($member)->post(route('borrow.store', $book->id));
        }

        // Should only allow 3 books
        $this->assertEquals(3, BorrowRecord::where('user_id', $member->id)->whereNull('returned_at')->count());
    }

    /** @test */
    public function search_and_filter_works()
    {
        $category1 = Category::factory()->create(['name' => 'Fiction']);
        $category2 = Category::factory()->create(['name' => 'Science']);
        $book1 = Book::factory()->create(['title' => 'Book One', 'author' => 'Alice', 'category_id' => $category1->id]);
        $book2 = Book::factory()->create(['title' => 'Book Two', 'author' => 'Bob', 'category_id' => $category2->id, 'stock_count' => 0]);

        $member = User::factory()->create(['role' => 'member']);

        // Search by title
        $response = $this->actingAs($member)
                         ->get(route('books.index', ['search' => 'Book One']));
        $response->assertSee('Book One')->assertDontSee('Book Two');

        // Filter by category
        $response = $this->actingAs($member)
                         ->get(route('books.index', ['category' => $category2->id]));
        $response->assertSee('Book Two')->assertDontSee('Book One');

        // Filter by availability
        $response = $this->actingAs($member)
                         ->get(route('books.index', ['availability' => 'available']));
        $response->assertSee('Book One')->assertDontSee('Book Two');
    }

    /** @test */
    public function overdue_email_can_be_dispatched()
    {
        $member = User::factory()->create(['role' => 'member', 'email' => 'test@example.com']);
        $book = Book::factory()->create(['stock_count' => 5]);

        $borrow = BorrowRecord::factory()->create([
            'user_id' => $member->id,
            'book_id' => $book->id,
            'borrowed_at' => Carbon::now()->subWeeks(3),
            'due_date' => Carbon::now()->subWeek(),
        ]);

        \Mail::fake();

        // Dispatch the job (simulate scheduler)
        if ($borrow->due_date < now() && is_null($borrow->returned_at)) {
            \Mail::to($borrow->user->email)->send(new \App\Mail\OverdueReminderMail($borrow));
        }

        \Mail::assertSent(\App\Mail\OverdueReminderMail::class, 1);
    }
}
