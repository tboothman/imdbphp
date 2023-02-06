<?php

namespace GraphQL\SchemaObject;

class TriviaFilterInputObject extends InputObject
{
    protected $categories;
    protected $spoilers;

    public function setCategories(array $categories)
    {
        $this->categories = $categories;

        return $this;
    }

    public function setSpoilers($spoilers)
    {
        $this->spoilers = $spoilers;

        return $this;
    }
}
