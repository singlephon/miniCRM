<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Ticket extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        'subject',
        'description',
        'customer_id',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'closed_at' => 'datetime',
        ];
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(
            Customer::class,
            'customer_id',
            'id'
        );
    }

    public function scopeCreatedSince(Builder $query, Carbon $date): void
    {
        $query->where('created_at', '>=', $date);
    }

    public function scopeClosedSince(Builder $query, Carbon $date): void
    {
        $query->where('status', 'closed')
            ->where('closed_at', '>=', $date);
    }
}
