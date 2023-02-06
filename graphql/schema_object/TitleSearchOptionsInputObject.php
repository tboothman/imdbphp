<?php

namespace GraphQL\SchemaObject;

class TitleSearchOptionsInputObject extends InputObject
{
    protected $type;

    public function setType(array $type)
    {
        $this->type = $type;

        return $this;
    }
}
