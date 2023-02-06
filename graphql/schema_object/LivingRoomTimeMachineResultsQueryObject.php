<?php

namespace GraphQL\SchemaObject;

class LivingRoomTimeMachineResultsQueryObject extends QueryObject
{
    const OBJECT_NAME = "LivingRoomTimeMachineResults";

    public function selectChoices(LivingRoomTimeMachineResultsChoicesArgumentsObject $argsObject = null)
    {
        $object = new LivingRoomGameAnswerQueryObject("choices");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNextQuestionId()
    {
        $this->selectField("nextQuestionId");

        return $this;
    }

    public function selectQuestion(LivingRoomTimeMachineResultsQuestionArgumentsObject $argsObject = null)
    {
        $object = new LivingRoomGameMultipleChoiceQuestionQueryObject("question");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTitles(LivingRoomTimeMachineResultsTitlesArgumentsObject $argsObject = null)
    {
        $object = new TitleQueryObject("titles");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
