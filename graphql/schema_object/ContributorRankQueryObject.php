<?php

namespace GraphQL\SchemaObject;

class ContributorRankQueryObject extends QueryObject
{
    const OBJECT_NAME = "ContributorRank";

    public function selectApprovedItems()
    {
        $this->selectField("approvedItems");

        return $this;
    }

    public function selectApprovedItemsDelta()
    {
        $this->selectField("approvedItemsDelta");

        return $this;
    }

    public function selectContributor(ContributorRankContributorArgumentsObject $argsObject = null)
    {
        $object = new ContributorQueryObject("contributor");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectRank()
    {
        $this->selectField("rank");

        return $this;
    }

    public function selectRankDelta()
    {
        $this->selectField("rankDelta");

        return $this;
    }
}
