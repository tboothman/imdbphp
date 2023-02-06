<?php

namespace GraphQL\SchemaObject;

class TitleQuoteLineQueryObject extends QueryObject
{
    const OBJECT_NAME = "TitleQuoteLine";

    public function selectCharacters(TitleQuoteLineCharactersArgumentsObject $argsObject = null)
    {
        $object = new TitleQuoteCharacterQueryObject("characters");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectStageDirection()
    {
        $this->selectField("stageDirection");

        return $this;
    }

    public function selectText()
    {
        $this->selectField("text");

        return $this;
    }
}
