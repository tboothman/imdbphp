<?php

namespace GraphQL\SchemaObject;

class AwardNominationEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "AwardNominationEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(AwardNominationEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new AwardNominationQueryObject("node");
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
