<?php

namespace GraphQL\SchemaObject;

class TitleKeywordItemCategoryQueryObject extends QueryObject
{
    const OBJECT_NAME = "TitleKeywordItemCategory";

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectItemCategoryId()
    {
        $this->selectField("itemCategoryId");

        return $this;
    }

    public function selectLanguage(TitleKeywordItemCategoryLanguageArgumentsObject $argsObject = null)
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
}
