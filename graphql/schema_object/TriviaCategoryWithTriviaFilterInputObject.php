<?php

namespace GraphQL\SchemaObject;

class TriviaCategoryWithTriviaFilterInputObject extends InputObject
{
    protected $spoilers;

    public function setSpoilers($spoilers)
    {
        $this->spoilers = $spoilers;

        return $this;
    }
}
