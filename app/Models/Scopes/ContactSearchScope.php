<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class ContactSearchScope extends SearchScope
{
    protected $searchColumns = [
        'first_name',
        'last_name',
        'email',
        'company.name',
    ];
}
