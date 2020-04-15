<?php

declare(strict_types=1);

namespace App\QueryFilters;

use Illuminate\Database\Eloquent\Builder;

class Year extends Filter
{
    /**
     * @var string
     */
    private $field;

    /**
     * @var int|null
     */
    protected $year;

    public function __construct(string $field, int $year = null)
    {
        $this->year = $year;
        $this->field = $field;
    }

    /**
     * @param Builder $builder
     * @return Builder
     */
    protected function applyFilter(Builder $builder): Builder
    {
        return $builder->whereYear($this->field, $this->year);
    }
}
