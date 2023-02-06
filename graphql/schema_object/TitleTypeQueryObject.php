<?php

namespace GraphQL\SchemaObject;

class TitleTypeQueryObject extends QueryObject
{
    const OBJECT_NAME = "TitleType";

    public function selectCanHaveEpisodes()
    {
        $this->selectField("canHaveEpisodes");

        return $this;
    }

    public function selectCategories(TitleTypeCategoriesArgumentsObject $argsObject = null)
    {
        $object = new TitleTypeCategoryQueryObject("categories");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectDisplayableProperty(TitleTypeDisplayablePropertyArgumentsObject $argsObject = null)
    {
        $object = new DisplayableTitleTypePropertyQueryObject("displayableProperty");
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

    public function selectIsEpisode()
    {
        $this->selectField("isEpisode");

        return $this;
    }

    public function selectIsSeries()
    {
        $this->selectField("isSeries");

        return $this;
    }

    public function selectLanguage(TitleTypeLanguageArgumentsObject $argsObject = null)
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
