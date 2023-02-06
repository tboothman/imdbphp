<?php

namespace GraphQL\SchemaObject;

class ImageEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "ImageEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(ImageEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new ImageQueryObject("node");
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
