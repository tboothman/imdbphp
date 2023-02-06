<?php

namespace GraphQL\SchemaObject;

class TrackRecommendationsInputInputObject extends InputObject
{
    protected $profession;

    public function setProfession($profession)
    {
        $this->profession = $profession;

        return $this;
    }
}
