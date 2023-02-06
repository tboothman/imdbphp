<?php

namespace GraphQL\SchemaObject;

class AdvancedTitleSearchEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "AdvancedTitleSearchEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(AdvancedTitleSearchEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new AdvancedTitleSearchResultQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
