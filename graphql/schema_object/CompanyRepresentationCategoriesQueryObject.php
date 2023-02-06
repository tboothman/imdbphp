<?php

namespace GraphQL\SchemaObject;

class CompanyRepresentationCategoriesQueryObject extends QueryObject
{
    const OBJECT_NAME = "CompanyRepresentationCategories";

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectLanguage(CompanyRepresentationCategoriesLanguageArgumentsObject $argsObject = null)
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

    public function selectTotal()
    {
        $this->selectField("total");

        return $this;
    }
}
