<?php

namespace GraphQL\SchemaObject;

class EpisodesSeasonQueryObject extends QueryObject
{
    const OBJECT_NAME = "EpisodesSeason";

    public function selectNumber()
    {
        $this->selectField("number");

        return $this;
    }
}
