<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'supplier_id',
        'document_type',
        'file_path',
        'original_name',
        'upload_date',
        'expiration_date',
        'status',
    ];

    protected $casts = [
        'upload_date' => 'datetime',
        'expiration_date' => 'date',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function getCalculatedStatusAttribute(): string
    {
        if (!$this->expiration_date) {
            return $this->status ?: 'valid';
        }

        $today = Carbon::today();
        $expiration = Carbon::parse($this->expiration_date)->startOfDay();

        if ($expiration->lt($today)) {
            return 'expired';
        }

        if ($expiration->diffInDays($today) <= 30) {
            return 'expiring';
        }

        return 'valid';
    }

    public function getStatusLabelAttribute(): string
    {
        return match ($this->calculated_status) {
            'expired' => 'Vencido',
            'expiring' => 'Próximo do vencimento',
            'pending' => 'Pendente',
            default => 'Válido',
        };
    }

    public function getStatusBadgeClassAttribute(): string
    {
        return match ($this->calculated_status) {
            'expired' => 'badge-inactive',
            'expiring' => 'badge-pending',
            default => 'badge-active',
        };
    }
}
