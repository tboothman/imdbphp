<?php

namespace GraphQL\SchemaObject;

class PollsConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "PollsConnection";

    public function selectEdges(PollsConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new PollEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(PollsConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTotal()
    {
        $this->selectField("total");

        return $this;
    }
}
