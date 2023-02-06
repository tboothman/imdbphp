<?php

namespace GraphQL\SchemaObject;

class TitleKeywordEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "TitleKeywordEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(TitleKeywordEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new TitleKeywordQueryObject("node");
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
