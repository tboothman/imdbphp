<?php

namespace GraphQL\SchemaObject;

class TitleSearchEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "TitleSearchEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(TitleSearchEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new TitleQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
