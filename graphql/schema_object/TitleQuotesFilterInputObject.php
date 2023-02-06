<?php

namespace GraphQL\SchemaObject;

class TitleQuotesFilterInputObject extends InputObject
{
    protected $names;
    protected $spoilers;

    public function setNames(array $names)
    {
        $this->names = $names;

        return $this;
    }

    public function setSpoilers($spoilers)
    {
        $this->spoilers = $spoilers;

        return $this;
    }
}
