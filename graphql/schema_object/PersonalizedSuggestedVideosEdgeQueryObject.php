<?php

namespace GraphQL\SchemaObject;

class PersonalizedSuggestedVideosEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "PersonalizedSuggestedVideosEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(PersonalizedSuggestedVideosEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new VideoQueryObject("node");
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
