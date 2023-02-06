<?php

namespace GraphQL\SchemaObject;

class HistogramValuesQueryObject extends QueryObject
{
    const OBJECT_NAME = "HistogramValues";

    public function selectRating()
    {
        $this->selectField("rating");

        return $this;
    }

    public function selectVoteCount()
    {
        $this->selectField("voteCount");

        return $this;
    }
}
