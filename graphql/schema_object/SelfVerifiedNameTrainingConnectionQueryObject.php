<?php

namespace GraphQL\SchemaObject;

class SelfVerifiedNameTrainingConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "SelfVerifiedNameTrainingConnection";

    public function selectEdges(SelfVerifiedNameTrainingConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new SelfVerifiedNameTrainingEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(SelfVerifiedNameTrainingConnectionPageInfoArgumentsObject $argsObject = null)
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
