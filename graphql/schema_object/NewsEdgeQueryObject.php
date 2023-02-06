<?php

namespace GraphQL\SchemaObject;

class NewsEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "NewsEdge";

    public function selectNode(NewsEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new NewsQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
