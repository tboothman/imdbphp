<?php

namespace GraphQL\SchemaObject;

class TitleContributionQuestionsArgumentsObject extends ArgumentsObject
{
    protected $filter;
    protected $first;

    public function setFilter(QuestionsFilterInputObject $questionsFilterInputObject)
    {
        $this->filter = $questionsFilterInputObject;

        return $this;
    }

    public function setFirst($first)
    {
        $this->first = $first;

        return $this;
    }
}
