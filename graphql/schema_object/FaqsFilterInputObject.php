<?php

namespace GraphQL\SchemaObject;

class FaqsFilterInputObject extends InputObject
{
    protected $hasAnswer;
    protected $spoilers;

    public function setHasAnswer($hasAnswer)
    {
        $this->hasAnswer = $hasAnswer;

        return $this;
    }

    public function setSpoilers($spoilers)
    {
        $this->spoilers = $spoilers;

        return $this;
    }
}
