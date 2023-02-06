<?php

namespace GraphQL\SchemaObject;

class KeywordTitleConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "KeywordTitleConnection";

    public function selectEdges(KeywordTitleConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new KeywordTitleEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(KeywordTitleConnectionPageInfoArgumentsObject $argsObject = null)
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
