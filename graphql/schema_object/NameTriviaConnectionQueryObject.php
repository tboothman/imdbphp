<?php

namespace GraphQL\SchemaObject;

class NameTriviaConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "NameTriviaConnection";

    public function selectEdges(NameTriviaConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new NameTriviaEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(NameTriviaConnectionPageInfoArgumentsObject $argsObject = null)
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
