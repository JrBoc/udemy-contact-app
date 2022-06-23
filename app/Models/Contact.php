<?php

namespace App\Models;

use App\Models\Scopes\ContactSearchScope;
use App\Models\Scopes\FilterScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    public function scopeLatestFirst($query)
    {
        return $query->orderBy('id', 'desc');
    }

    protected static function booted()
    {
        static::addGlobalScope(new FilterScope());
        static::addGlobalScope(new ContactSearchScope());
    }
}
