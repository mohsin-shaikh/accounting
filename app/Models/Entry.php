<?php

namespace App\Models;

use Illuminate\Support\Str;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Entry extends Model
{
    use HasFactory, Searchable;

    protected $fillable = ['amount', 'details', 'type', 'customer_id', 'date'];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Generate uuid for the entry.
     */
    public static function booted(): void
    {
        static::creating(function ($team) {
            $team->uuid = Str::uuid();
        });
    }
}
