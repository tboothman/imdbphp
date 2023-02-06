<?php

namespace GraphQL\SchemaObject;

class RuntimeSearchConstraintInputObject extends InputObject
{
    protected $runtimeRangeMinutes;

    public function setRuntimeRangeMinutes(IntRangeInputInputObject $intRangeInputInputObject)
    {
        $this->runtimeRangeMinutes = $intRangeInputInputObject;

        return $this;
    }
}
