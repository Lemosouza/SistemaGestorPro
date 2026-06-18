<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Analysis extends Model
{
        protected $fillable = [
        'company_id',
        'supplier_id',
        'status',
        'description',
        'evaluation_date',
        'validity_date',
    ];

    protected $casts = [
        'evaluation_date' => 'datetime',
        'validity_date'   => 'datetime',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
