<?php

namespace GraphQL\SchemaObject;

class FaqQueryObject extends QueryObject
{
    const OBJECT_NAME = "Faq";

    public function selectAnswer(FaqAnswerArgumentsObject $argsObject = null)
    {
        $object = new MarkdownQueryObject("answer");
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

    public function selectIsSpoiler()
    {
        $this->selectField("isSpoiler");

        return $this;
    }

    public function selectLanguage(FaqLanguageArgumentsObject $argsObject = null)
    {
        $object = new DisplayableLanguageQueryObject("language");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectQuestion(FaqQuestionArgumentsObject $argsObject = null)
    {
        $object = new MarkdownQueryObject("question");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
