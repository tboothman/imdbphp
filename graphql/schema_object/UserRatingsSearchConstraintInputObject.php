<?php

namespace GraphQL\SchemaObject;

class UserRatingsSearchConstraintInputObject extends InputObject
{
    protected $aggregateRatingRange;
    protected $ratingsCountRange;

    public function setAggregateRatingRange(FloatRangeInputInputObject $floatRangeInputInputObject)
    {
        $this->aggregateRatingRange = $floatRangeInputInputObject;

        return $this;
    }

    public function setRatingsCountRange(IntRangeInputInputObject $intRangeInputInputObject)
    {
        $this->ratingsCountRange = $intRangeInputInputObject;

        return $this;
    }
}
