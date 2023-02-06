<?php

namespace GraphQL\SchemaObject;

class TitleGenresQueryObject extends QueryObject
{
    const OBJECT_NAME = "TitleGenres";

    public function selectGenres(TitleGenresGenresArgumentsObject $argsObject = null)
    {
        $object = new TitleGenreQueryObject("genres");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
