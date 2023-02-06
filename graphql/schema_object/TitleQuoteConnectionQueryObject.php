<?php

namespace GraphQL\SchemaObject;

class TitleQuoteConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "TitleQuoteConnection";

    public function selectEdges(TitleQuoteConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new TitleQuoteEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(TitleQuoteConnectionPageInfoArgumentsObject $argsObject = null)
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
