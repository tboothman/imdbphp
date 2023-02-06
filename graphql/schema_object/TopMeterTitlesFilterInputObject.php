<?php

namespace GraphQL\SchemaObject;

class TopMeterTitlesFilterInputObject extends InputObject
{
    protected $genreId;
    protected $topMeterTitlesType;

    public function setGenreId($genreId)
    {
        $this->genreId = $genreId;

        return $this;
    }

    public function setTopMeterTitlesType($topMeterTitlesType)
    {
        $this->topMeterTitlesType = $topMeterTitlesType;

        return $this;
    }
}
