<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Supplier extends Model
{
    protected $fillable = [
        'supplier_name',
        'email',
        'phone',
        'address',
    ];

    public function quotations(): HasMany
    {
        return $this->hasMany(Quotation::class);
    }
}
