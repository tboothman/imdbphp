<?php

namespace GraphQL\SchemaObject;

class TitleReviewsArgumentsObject extends ArgumentsObject
{
    protected $after;
    protected $filter;
    protected $first;
    protected $sort;

    public function setAfter($after)
    {
        $this->after = $after;

        return $this;
    }

    public function setFilter(ReviewsFilterInputObject $reviewsFilterInputObject)
    {
        $this->filter = $reviewsFilterInputObject;

        return $this;
    }

    public function setFirst($first)
    {
        $this->first = $first;

        return $this;
    }

    public function setSort(ReviewsSortInputObject $reviewsSortInputObject)
    {
        $this->sort = $reviewsSortInputObject;

        return $this;
    }
}
