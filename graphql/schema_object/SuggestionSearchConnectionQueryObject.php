<?php

namespace GraphQL\SchemaObject;

class SuggestionSearchConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "SuggestionSearchConnection";

    public function selectEdges(SuggestionSearchConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new SuggestionSearchEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(SuggestionSearchConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
