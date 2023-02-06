<?php

namespace GraphQL\SchemaObject;

class TitleConnectionEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "TitleConnectionEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(TitleConnectionEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new TitleConnectionQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPosition()
    {
        $this->selectField("position");

        return $this;
    }
}
