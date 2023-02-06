<?php

namespace GraphQL\SchemaObject;

class LivingRoomCustomWidgetResultsQueryObject extends QueryObject
{
    const OBJECT_NAME = "LivingRoomCustomWidgetResults";

    public function selectChoices(LivingRoomCustomWidgetResultsChoicesArgumentsObject $argsObject = null)
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

    public function selectQuestion(LivingRoomCustomWidgetResultsQuestionArgumentsObject $argsObject = null)
    {
        $object = new LivingRoomGameMultipleChoiceQuestionQueryObject("question");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTitles(LivingRoomCustomWidgetResultsTitlesArgumentsObject $argsObject = null)
    {
        $object = new TitleQueryObject("titles");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
