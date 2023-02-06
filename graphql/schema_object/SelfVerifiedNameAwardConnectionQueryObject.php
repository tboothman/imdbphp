<?php

namespace GraphQL\SchemaObject;

class SelfVerifiedNameAwardConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "SelfVerifiedNameAwardConnection";

    public function selectEdges(SelfVerifiedNameAwardConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new SelfVerifiedNameAwardEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(SelfVerifiedNameAwardConnectionPageInfoArgumentsObject $argsObject = null)
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
