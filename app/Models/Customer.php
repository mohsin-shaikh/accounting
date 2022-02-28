<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'mobile', 'book_id'];

    // protected $table = 'customers';

    // protected $hidden = ['created_at', 'updated_at'];

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }

    public function entries(): HasMany
    {
        return $this->hasMany(Entry::class);
    }
}
