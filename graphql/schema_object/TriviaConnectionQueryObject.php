<?php

namespace GraphQL\SchemaObject;

class TriviaConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "TriviaConnection";

    public function selectEdges(TriviaConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new TriviaEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(TriviaConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectRestriction(TriviaConnectionRestrictionArgumentsObject $argsObject = null)
    {
        $object = new TriviaRestrictionQueryObject("restriction");
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
