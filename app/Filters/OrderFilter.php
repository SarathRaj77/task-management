<?php

namespace App\Filters;

use Closure;

class OrderFilter
{
    public function handle($request, Closure $next)
    {
        $builder = $next($request);
        if (request()->filled('order'))
            $builder->orderBy('id', request()->order);
        return $builder;
    }
}
