<?php

namespace GraphQL\SchemaObject;

class FeedbackGivenInputInputObject extends InputObject
{
    protected $featureType;

    public function setFeatureType($featureType)
    {
        $this->featureType = $featureType;

        return $this;
    }
}
