<?php

namespace GraphQL\SchemaObject;

class ParentsGuideCategoryFilterInputObject extends InputObject
{
    protected $spoilers;

    public function setSpoilers($spoilers)
    {
        $this->spoilers = $spoilers;

        return $this;
    }
}
