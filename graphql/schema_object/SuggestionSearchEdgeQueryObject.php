<?php

namespace GraphQL\SchemaObject;

class SuggestionSearchEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "SuggestionSearchEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(SuggestionSearchEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new SuggestionSearchItemQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
