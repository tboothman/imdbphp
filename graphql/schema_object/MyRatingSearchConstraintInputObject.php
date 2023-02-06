<?php

namespace GraphQL\SchemaObject;

class MyRatingSearchConstraintInputObject extends InputObject
{
    protected $filterType;
    protected $ratingRange;

    public function setFilterType($filterType)
    {
        $this->filterType = $filterType;

        return $this;
    }

    public function setRatingRange(IntRangeInputInputObject $intRangeInputInputObject)
    {
        $this->ratingRange = $intRangeInputInputObject;

        return $this;
    }
}
