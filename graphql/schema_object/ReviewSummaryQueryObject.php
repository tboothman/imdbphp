<?php

namespace GraphQL\SchemaObject;

class ReviewSummaryQueryObject extends QueryObject
{
    const OBJECT_NAME = "ReviewSummary";

    public function selectOriginalText()
    {
        $this->selectField("originalText");

        return $this;
    }
}
