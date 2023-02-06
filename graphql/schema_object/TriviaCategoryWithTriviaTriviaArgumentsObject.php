<?php

namespace GraphQL\SchemaObject;

class TriviaCategoryWithTriviaTriviaArgumentsObject extends ArgumentsObject
{
    protected $filter;
    protected $first;

    public function setFilter(TriviaCategoryWithTriviaFilterInputObject $triviaCategoryWithTriviaFilterInputObject)
    {
        $this->filter = $triviaCategoryWithTriviaFilterInputObject;

        return $this;
    }

    public function setFirst($first)
    {
        $this->first = $first;

        return $this;
    }
}
