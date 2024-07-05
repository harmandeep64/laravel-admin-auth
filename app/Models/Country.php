<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'iso', 'flag', 'country_code', 'min_phone_number_length', 'max_phone_number_length', 'created_at', 'updated_at', 'status'];

    public function scopeActive()
    {
        return $this->where('status', 1);
    }
}
