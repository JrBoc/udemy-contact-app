<?php

namespace App\Models;

use App\Models\Scopes\CompanySearchScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function contact()
    {
        return $this->hasMany(Contact::class, 'company_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public static function userCompanies($prependText = 'All Companies')
    {
        return self::where('user_id', auth()->id())->orderBy('name')->pluck('name', 'id')->prepend($prependText, '');
    }

    protected static function booted()
    {
        static::addGlobalScope(new CompanySearchScope());
    }
}
