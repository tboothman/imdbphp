<?php

namespace GraphQL\SchemaObject;

class RootTopTrendingSetsPredefinedArgumentsObject extends ArgumentsObject
{
    protected $after;
    protected $first;
    protected $input;

    public function setAfter($after)
    {
        $this->after = $after;

        return $this;
    }

    public function setFirst($first)
    {
        $this->first = $first;

        return $this;
    }

    public function setInput(TopTrendingSetsPredefinedInputInputObject $topTrendingSetsPredefinedInputInputObject)
    {
        $this->input = $topTrendingSetsPredefinedInputInputObject;

        return $this;
    }
}
