<?php

namespace App\Filters;

use Closure;

class AssingnedUserFilter
{
    public function handle($request, Closure $next)
    {
        $builder = $next($request);
        if (request()->filled('user_ids'))
            $builder->whereIn('assigned_to', request()->user_ids);
        return $builder;
    }
}
