<?php

namespace GraphQL\SchemaObject;

class SelfVerifiedNameEducationalHistoryConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "SelfVerifiedNameEducationalHistoryConnection";

    public function selectEdges(SelfVerifiedNameEducationalHistoryConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new SelfVerifiedNameEducationEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(SelfVerifiedNameEducationalHistoryConnectionPageInfoArgumentsObject $argsObject = null)
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
