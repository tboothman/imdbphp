<?php

namespace GraphQL\SchemaObject;

class PollAnswersConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "PollAnswersConnection";

    public function selectEdges(PollAnswersConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new PollAnswerEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(PollAnswersConnectionPageInfoArgumentsObject $argsObject = null)
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
