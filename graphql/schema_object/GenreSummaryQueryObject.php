<?php

namespace GraphQL\SchemaObject;

class GenreSummaryQueryObject extends QueryObject
{
    const OBJECT_NAME = "GenreSummary";

    public function selectGenre(GenreSummaryGenreArgumentsObject $argsObject = null)
    {
        $object = new GenreItemQueryObject("genre");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTotal()
    {
        $this->selectField("total");

        return $this;
    }
}
