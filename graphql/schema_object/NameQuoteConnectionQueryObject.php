<?php

namespace GraphQL\SchemaObject;

class NameQuoteConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "NameQuoteConnection";

    public function selectEdges(NameQuoteConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new NameQuoteEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(NameQuoteConnectionPageInfoArgumentsObject $argsObject = null)
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
