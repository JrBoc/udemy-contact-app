<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'email',
        'website',
    ];

    public function contact()
    {
        return $this->hasMany(Contact::class, 'company_id', 'id');
    }
}