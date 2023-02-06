<?php

namespace GraphQL\SchemaObject;

class TitleMeterSearchConstraintInputObject extends InputObject
{
    protected $rankRange;

    public function setRankRange(IntRangeInputInputObject $intRangeInputInputObject)
    {
        $this->rankRange = $intRangeInputInputObject;

        return $this;
    }
}
