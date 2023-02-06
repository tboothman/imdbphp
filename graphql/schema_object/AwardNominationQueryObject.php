<?php

namespace GraphQL\SchemaObject;

class AwardNominationQueryObject extends QueryObject
{
    const OBJECT_NAME = "AwardNomination";

    public function selectAward(AwardNominationAwardArgumentsObject $argsObject = null)
    {
        $object = new AwardDetailsQueryObject("award");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectAwardedEntities(AwardNominationAwardedEntitiesArgumentsObject $argsObject = null)
    {
        $object = new AwardedEntitiesUnionObject("awardedEntities");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectForEpisodes(AwardNominationForEpisodesArgumentsObject $argsObject = null)
    {
        $object = new TitleQueryObject("forEpisodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectForSongTitles()
    {
        $this->selectField("forSongTitles");

        return $this;
    }

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectIsWinner()
    {
        $this->selectField("isWinner");

        return $this;
    }
}
