<?php

namespace GraphQL\SchemaObject;

class ExternalLinkEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "ExternalLinkEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(ExternalLinkEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new ExternalLinkQueryObject("node");
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
