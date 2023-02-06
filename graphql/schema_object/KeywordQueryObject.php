<?php

namespace GraphQL\SchemaObject;

class KeywordQueryObject extends QueryObject
{
    const OBJECT_NAME = "Keyword";

    public function selectCategory(KeywordCategoryArgumentsObject $argsObject = null)
    {
        $object = new KeywordCategoryQueryObject("category");
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

    public function selectText(KeywordTextArgumentsObject $argsObject = null)
    {
        $object = new KeywordTextQueryObject("text");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTitles(KeywordTitlesArgumentsObject $argsObject = null)
    {
        $object = new KeywordTitleConnectionQueryObject("titles");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
