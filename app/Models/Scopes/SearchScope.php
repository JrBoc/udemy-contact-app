<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class SearchScope implements Scope
{
    protected $searchColumn = [];

    public function apply(Builder $builder, Model $model)
    {
        if ($search = request('search')) {
            foreach ($this->searchColumn as $column) {
                $array = explode('.', $column);

                if (count($array) === 2) {
                    list($relationship, $col) = $array;

                    $builder->orWhereHas($relationship, function ($query) use ($search, $col) {
                        $query->where($col, 'LIKE', "%{$search}%");
                    });
                } else {
                    $builder->where($column, 'LIKE', "%{$search}%");

                }
            }
        }
    }
}
