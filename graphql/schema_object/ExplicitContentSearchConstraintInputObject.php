<?php

namespace GraphQL\SchemaObject;

class ExplicitContentSearchConstraintInputObject extends InputObject
{
    protected $explicitContentFilter;

    public function setExplicitContentFilter($explicitContentFilter)
    {
        $this->explicitContentFilter = $explicitContentFilter;

        return $this;
    }
}
