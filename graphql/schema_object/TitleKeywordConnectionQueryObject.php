<?php

namespace GraphQL\SchemaObject;

class TitleKeywordConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "TitleKeywordConnection";

    public function selectEdges(TitleKeywordConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new TitleKeywordEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(TitleKeywordConnectionPageInfoArgumentsObject $argsObject = null)
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
