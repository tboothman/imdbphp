<?php

namespace GraphQL\SchemaObject;

class EpisodesYearQueryObject extends QueryObject
{
    const OBJECT_NAME = "EpisodesYear";

    public function selectYear()
    {
        $this->selectField("year");

        return $this;
    }
}
