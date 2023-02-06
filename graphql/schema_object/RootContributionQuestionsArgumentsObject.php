<?php

namespace GraphQL\SchemaObject;

class RootContributionQuestionsArgumentsObject extends ArgumentsObject
{
    protected $after;
    protected $filter;
    protected $first;
    protected $pinnedQuestion;

    public function setAfter($after)
    {
        $this->after = $after;

        return $this;
    }

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

    public function setPinnedQuestion($pinnedQuestion)
    {
        $this->pinnedQuestion = $pinnedQuestion;

        return $this;
    }
}
