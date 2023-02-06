<?php

namespace GraphQL\SchemaObject;

class AwardNominationConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "AwardNominationConnection";

    public function selectEdges(AwardNominationConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new AwardNominationEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(AwardNominationConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTotal()
    {
        $this->selectField("total");

        return $this;
    }
}
