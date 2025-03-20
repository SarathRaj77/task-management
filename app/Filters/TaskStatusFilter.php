<?php

namespace App\Filters;

use Closure;

class TaskStatusFilter
{
    public function handle($request, Closure $next)
    {
        $builder = $next($request);
        if (request()->filled('status'))
            $builder->where('status', request()->status);
        return $builder;
    }
}
