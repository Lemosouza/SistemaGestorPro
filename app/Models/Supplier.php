<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'document',
        'category',
        'contact_name',
        'contact_email',
        'contact_phone',
        'address',
        'notes',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    public function analyses()
    {
        return $this->hasMany(Analysis::class);
    }

    public function getGeneralStatusAttribute(): string
    {
        if ($this->status !== 'active') {
            return 'irregular';
        }

        $hasExpired = $this->documents->contains(function ($document) {
            return $document->calculated_status === 'expired';
        });

        return $hasExpired ? 'irregular' : 'regular';
    }
}
