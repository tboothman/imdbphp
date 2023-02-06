<?php

namespace GraphQL\SchemaObject;

class ParentsGuideEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "ParentsGuideEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(ParentsGuideEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new ParentsGuideItemQueryObject("node");
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
