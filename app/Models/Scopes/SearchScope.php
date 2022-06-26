<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class SearchScope implements Scope
{
    protected $searchColumns = [];

    public function apply(Builder $builder, Model $model)
    {
        if ($search = request('search')) {
            $columns = property_exists($model, 'searchColumns') ? $model->searchColumns : $this->searchColumns;

            foreach ($columns as $index => $column) {
                $array = explode('.', $column);

                $method = $index === 0 ? 'where' : 'orWhere';

                if (count($array) === 2) {
                    $method .= 'Has';

                    list($relationship, $col) = $array;

                    $builder->$method($relationship, function ($query) use ($search, $col) {
                        $query->where($col, 'LIKE', "%{$search}%");
                    });
                } else {
                    $builder->$method($column, 'LIKE', "%{$search}%");
                }
            }
        }
    }
}
