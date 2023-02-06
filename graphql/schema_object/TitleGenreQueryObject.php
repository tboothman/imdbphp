<?php

namespace GraphQL\SchemaObject;

class TitleGenreQueryObject extends QueryObject
{
    const OBJECT_NAME = "TitleGenre";

    public function selectGenre(TitleGenreGenreArgumentsObject $argsObject = null)
    {
        $object = new GenreItemQueryObject("genre");
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

    public function selectSubGenres(TitleGenreSubGenresArgumentsObject $argsObject = null)
    {
        $object = new TitleKeywordQueryObject("subGenres");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
