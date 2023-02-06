<?php

namespace GraphQL\SchemaObject;

class TitleKeywordsSortInputObject extends InputObject
{
    protected $by;

    public function setBy($by)
    {
        $this->by = $by;

        return $this;
    }
}
