<?php

namespace App\Models\Scopes;

class CompanySearchScope extends SearchScope
{
    protected $searchColumns = [
        'name',
        'website',
        'email',
    ];
}
