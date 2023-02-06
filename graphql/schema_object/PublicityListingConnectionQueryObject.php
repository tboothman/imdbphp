<?php

namespace GraphQL\SchemaObject;

class PublicityListingConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "PublicityListingConnection";

    public function selectEdges(PublicityListingConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new PublicityListingEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(PublicityListingConnectionPageInfoArgumentsObject $argsObject = null)
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
