<?php

namespace GraphQL\SchemaObject;

class NameKnownForEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "NameKnownForEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(NameKnownForEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new NameKnownForQueryObject("node");
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
