<?php

namespace GraphQL\SchemaObject;

class PollAnswerQueryObject extends QueryObject
{
    const OBJECT_NAME = "PollAnswer";

    public function selectItem(PollAnswerItemArgumentsObject $argsObject = null)
    {
        $object = new AnswerItemUnionObject("item");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
