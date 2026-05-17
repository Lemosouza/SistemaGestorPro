<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
        protected $fillable = [
        'supplier_id',
        'document_type',
        'upload_date',
        'status',
    ];

    protected $casts = [
        'upload_date' => 'datetime',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
