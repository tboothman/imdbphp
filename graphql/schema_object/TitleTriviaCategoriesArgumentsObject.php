<?php

namespace GraphQL\SchemaObject;

class TitleTriviaCategoriesArgumentsObject extends ArgumentsObject
{
    protected $filter;

    public function setFilter(TriviaCategoryWithTriviaFilterInputObject $triviaCategoryWithTriviaFilterInputObject)
    {
        $this->filter = $triviaCategoryWithTriviaFilterInputObject;

        return $this;
    }
}
