<?php

namespace GraphQL\SchemaObject;

class ReviewHelpfulnessQueryObject extends QueryObject
{
    const OBJECT_NAME = "ReviewHelpfulness";

    public function selectDownVotes()
    {
        $this->selectField("downVotes");

        return $this;
    }

    public function selectScore()
    {
        $this->selectField("score");

        return $this;
    }

    public function selectUpVotes()
    {
        $this->selectField("upVotes");

        return $this;
    }
}
