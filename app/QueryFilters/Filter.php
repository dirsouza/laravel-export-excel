<?php

declare(strict_types=1);

namespace App\QueryFilters;

use Closure;
use Illuminate\Database\Eloquent\Builder;

abstract class Filter
{
    /**
     * @param Builder $builder
     * @param Closure $next
     * @return Builder
     */
    public function handle(Builder $builder, Closure $next): Builder
    {
        if (is_null($this->year)) {
            return $next($builder);
        }

        return $this->applyFilter($next($builder));
    }

    /**
     * @param Builder $builder
     * @return Builder
     */
    protected abstract function applyFilter(Builder $builder): Builder;
}
