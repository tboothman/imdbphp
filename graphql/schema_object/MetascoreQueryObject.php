<?php

namespace GraphQL\SchemaObject;

class MetascoreQueryObject extends QueryObject
{
    const OBJECT_NAME = "Metascore";

    public function selectReviewCount()
    {
        $this->selectField("reviewCount");

        return $this;
    }

    public function selectScore()
    {
        $this->selectField("score");

        return $this;
    }
}
