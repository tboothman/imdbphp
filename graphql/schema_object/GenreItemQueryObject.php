<?php

namespace GraphQL\SchemaObject;

class GenreItemQueryObject extends QueryObject
{
    const OBJECT_NAME = "GenreItem";

    public function selectDisplayableProperty(GenreItemDisplayablePropertyArgumentsObject $argsObject = null)
    {
        $object = new DisplayableTitleGenrePropertyQueryObject("displayableProperty");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectGenreId()
    {
        $this->selectField("genreId");

        return $this;
    }

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectLanguage(GenreItemLanguageArgumentsObject $argsObject = null)
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
