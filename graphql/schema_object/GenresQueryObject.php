<?php

namespace GraphQL\SchemaObject;

class GenresQueryObject extends QueryObject
{
    const OBJECT_NAME = "Genres";

    public function selectGenres(GenresGenresArgumentsObject $argsObject = null)
    {
        $object = new GenreQueryObject("genres");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectLanguage(GenresLanguageArgumentsObject $argsObject = null)
    {
        $object = new DisplayableLanguageQueryObject("language");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
