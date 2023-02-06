<?php

namespace GraphQL\SchemaObject;

class EpisodeNumberQueryObject extends QueryObject
{
    const OBJECT_NAME = "EpisodeNumber";

    public function selectEpisodeNumber()
    {
        $this->selectField("episodeNumber");

        return $this;
    }

    public function selectSeasonNumber()
    {
        $this->selectField("seasonNumber");

        return $this;
    }
}
