<?php

namespace GraphQL\SchemaObject;

class RootTopTrendingTitlesArgumentsObject extends ArgumentsObject
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

    public function setInput(TopTrendingInputInputObject $topTrendingInputInputObject)
    {
        $this->input = $topTrendingInputInputObject;

        return $this;
    }
}
