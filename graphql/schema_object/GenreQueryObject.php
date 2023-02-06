<?php

namespace GraphQL\SchemaObject;

class GenreQueryObject extends QueryObject
{
    const OBJECT_NAME = "Genre";

    public function selectDisplayableProperty(GenreDisplayablePropertyArgumentsObject $argsObject = null)
    {
        $object = new DisplayableTitleGenrePropertyQueryObject("displayableProperty");
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

    public function selectLanguage(GenreLanguageArgumentsObject $argsObject = null)
    {
        $object = new DisplayableLanguageQueryObject("language");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectRelevanceRanking()
    {
        $this->selectField("relevanceRanking");

        return $this;
    }

    public function selectSubgenres(GenreSubgenresArgumentsObject $argsObject = null)
    {
        $object = new TitleKeywordQueryObject("subgenres");
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
