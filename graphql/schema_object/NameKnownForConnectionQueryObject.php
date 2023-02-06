<?php

namespace GraphQL\SchemaObject;

class NameKnownForConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "NameKnownForConnection";

    public function selectEdges(NameKnownForConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new NameKnownForEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(NameKnownForConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectRestriction(NameKnownForConnectionRestrictionArgumentsObject $argsObject = null)
    {
        $object = new NameKnownForRestrictionQueryObject("restriction");
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
