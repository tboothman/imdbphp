<?php

namespace GraphQL\SchemaObject;

class SearchAwardEventQueryObject extends QueryObject
{
    const OBJECT_NAME = "SearchAwardEvent";

    public function selectAwardCategories(SearchAwardEventAwardCategoriesArgumentsObject $argsObject = null)
    {
        $object = new SearchAwardCategoryQueryObject("awardCategories");
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

    public function selectLanguage(SearchAwardEventLanguageArgumentsObject $argsObject = null)
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
