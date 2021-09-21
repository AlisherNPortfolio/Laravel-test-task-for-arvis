<?php

namespace App\FilterQuery;

use Closure;

class SearchByProduct
{
    public function handle($request, Closure $next)
    {
        if (!request()->has('product_id')) {
            return $next($request);
        }

        return $next($request)->where('product_id', request()->input('product_id'));
    }
}
