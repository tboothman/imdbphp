<?php

namespace GraphQL\SchemaObject;

class RegionCertificateRatingInputInputObject extends InputObject
{
    protected $rating;
    protected $region;

    public function setRating($rating)
    {
        $this->rating = $rating;

        return $this;
    }

    public function setRegion($region)
    {
        $this->region = $region;

        return $this;
    }
}
