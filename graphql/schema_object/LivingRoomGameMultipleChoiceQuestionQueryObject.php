<?php

namespace GraphQL\SchemaObject;

class LivingRoomGameMultipleChoiceQuestionQueryObject extends QueryObject
{
    const OBJECT_NAME = "LivingRoomGameMultipleChoiceQuestion";

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectLanguage(LivingRoomGameMultipleChoiceQuestionLanguageArgumentsObject $argsObject = null)
    {
        $object = new DisplayableLanguageQueryObject("language");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectText()
    {
        $this->selectField("text");

        return $this;
    }

    public function selectTokens(LivingRoomGameMultipleChoiceQuestionTokensArgumentsObject $argsObject = null)
    {
        $object = new LivingRoomGameTextTokenQueryObject("tokens");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
