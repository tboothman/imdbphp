<?php

namespace GraphQL\SchemaObject;

class PollQueryObject extends QueryObject
{
    const OBJECT_NAME = "Poll";

    public function selectAnswers(PollAnswersArgumentsObject $argsObject = null)
    {
        $object = new PollAnswersConnectionQueryObject("answers");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectPrimaryImage(PollPrimaryImageArgumentsObject $argsObject = null)
    {
        $object = new PollPrimaryImageQueryObject("primaryImage");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectQuestion(PollQuestionArgumentsObject $argsObject = null)
    {
        $object = new PollQuestionQueryObject("question");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
