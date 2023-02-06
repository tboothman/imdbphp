<?php

namespace GraphQL\SchemaObject;

class SelfVerifiedNameReferenceConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "SelfVerifiedNameReferenceConnection";

    public function selectEdges(SelfVerifiedNameReferenceConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new SelfVerifiedNameReferenceEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(SelfVerifiedNameReferenceConnectionPageInfoArgumentsObject $argsObject = null)
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
