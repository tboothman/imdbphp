<?php

namespace GraphQL\SchemaObject;

class SuggestionSearchFilterInputObject extends InputObject
{
    protected $type;

    public function setType(array $type)
    {
        $this->type = $type;

        return $this;
    }
}
