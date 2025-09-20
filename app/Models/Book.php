<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'category_id',
        'published_year',
        'stock_count',
    ];

    // Relation to category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relation to borrow records
    public function borrow_records()
    {
        return $this->hasMany(BorrowRecord::class);
    }
}
