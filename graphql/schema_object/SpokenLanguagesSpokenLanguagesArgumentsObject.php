<?php

namespace GraphQL\SchemaObject;

class SpokenLanguagesSpokenLanguagesArgumentsObject extends ArgumentsObject
{
    protected $limit;

    public function setLimit($limit)
    {
        $this->limit = $limit;

        return $this;
    }
}