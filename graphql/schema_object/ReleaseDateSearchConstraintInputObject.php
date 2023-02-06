<?php

namespace GraphQL\SchemaObject;

class ReleaseDateSearchConstraintInputObject extends InputObject
{
    protected $releaseDateRange;

    public function setReleaseDateRange(DateRangeInputObject $dateRangeInputObject)
    {
        $this->releaseDateRange = $dateRangeInputObject;

        return $this;
    }
}
