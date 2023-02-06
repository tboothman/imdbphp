<?php

namespace GraphQL\SchemaObject;

class PollAnswersArgumentsObject extends ArgumentsObject
{
    protected $first;

    public function setFirst($first)
    {
        $this->first = $first;

        return $this;
    }
}
