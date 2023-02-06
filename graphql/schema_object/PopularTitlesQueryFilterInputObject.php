<?php

namespace GraphQL\SchemaObject;

class PopularTitlesQueryFilterInputObject extends InputObject
{
    protected $filterOutUserRatings;
    protected $releaseDateRange;

    public function setFilterOutUserRatings($filterOutUserRatings)
    {
        $this->filterOutUserRatings = $filterOutUserRatings;

        return $this;
    }

    public function setReleaseDateRange(DateRangeInputObject $dateRangeInputObject)
    {
        $this->releaseDateRange = $dateRangeInputObject;

        return $this;
    }
}
