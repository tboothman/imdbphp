<?php

namespace GraphQL\SchemaObject;

class NameKnownForSummaryQueryObject extends QueryObject
{
    const OBJECT_NAME = "NameKnownForSummary";

    public function selectEpisodeCount()
    {
        $this->selectField("episodeCount");

        return $this;
    }

    public function selectPrincipalCategory(NameKnownForSummaryPrincipalCategoryArgumentsObject $argsObject = null)
    {
        $object = new CreditCategoryQueryObject("principalCategory");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPrincipalCharacters(NameKnownForSummaryPrincipalCharactersArgumentsObject $argsObject = null)
    {
        $object = new CharacterQueryObject("principalCharacters");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPrincipalJobs(NameKnownForSummaryPrincipalJobsArgumentsObject $argsObject = null)
    {
        $object = new CrewJobQueryObject("principalJobs");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectYearRange(NameKnownForSummaryYearRangeArgumentsObject $argsObject = null)
    {
        $object = new YearRangeQueryObject("yearRange");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
