<?php

namespace GraphQL\SchemaObject;

class CompanyCreditConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "CompanyCreditConnection";

    public function selectEdges(CompanyCreditConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new CompanyCreditEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(CompanyCreditConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectRestriction(CompanyCreditConnectionRestrictionArgumentsObject $argsObject = null)
    {
        $object = new CompanyCreditRestrictionQueryObject("restriction");
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
