<?php

namespace GraphQL\SchemaObject;

class FeedbackGivenQueryObject extends QueryObject
{
    const OBJECT_NAME = "FeedbackGiven";

    public function selectHasGivenFeedback()
    {
        $this->selectField("hasGivenFeedback");

        return $this;
    }
}
