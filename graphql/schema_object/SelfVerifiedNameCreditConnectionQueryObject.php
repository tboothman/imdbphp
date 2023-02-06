<?php

namespace GraphQL\SchemaObject;

class SelfVerifiedNameCreditConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "SelfVerifiedNameCreditConnection";

    public function selectEdges(SelfVerifiedNameCreditConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new SelfVerifiedNameCreditEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(SelfVerifiedNameCreditConnectionPageInfoArgumentsObject $argsObject = null)
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
