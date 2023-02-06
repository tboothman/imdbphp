<?php

namespace GraphQL\SchemaObject;

class DemographicRatingsQueryObject extends QueryObject
{
    const OBJECT_NAME = "DemographicRatings";

    public function selectAggregate()
    {
        $this->selectField("aggregate");

        return $this;
    }

    public function selectDemographic(DemographicRatingsDemographicArgumentsObject $argsObject = null)
    {
        $object = new DemographicQueryObject("demographic");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectVoteCount()
    {
        $this->selectField("voteCount");

        return $this;
    }
}
