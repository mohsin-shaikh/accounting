<?php

namespace App\Models;

use App\Models\Team;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory, Searchable;

    protected $fillable = ['name', 'mobile', 'book_id'];

    // protected $table = 'customers';

    // protected $hidden = ['created_at', 'updated_at'];

    public function book(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function entries(): HasMany
    {
        return $this->hasMany(Entry::class);
    }
}
