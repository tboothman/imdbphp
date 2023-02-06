<?php

namespace GraphQL\SchemaObject;

class RootShowtimesTitlesArgumentsObject extends ArgumentsObject
{
    protected $first;
    protected $location;
    protected $queryMetadata;

    public function setFirst($first)
    {
        $this->first = $first;

        return $this;
    }

    public function setLocation(ShowtimesLocationInputObject $showtimesLocationInputObject)
    {
        $this->location = $showtimesLocationInputObject;

        return $this;
    }

    public function setQueryMetadata(ShowtimesTitlesQueryMetadataInputObject $showtimesTitlesQueryMetadataInputObject)
    {
        $this->queryMetadata = $showtimesTitlesQueryMetadataInputObject;

        return $this;
    }
}
