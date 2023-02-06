<?php

namespace GraphQL\SchemaObject;

class ContributorLeaderboardsQueryObject extends QueryObject
{
    const OBJECT_NAME = "ContributorLeaderboards";

    public function selectAll(ContributorLeaderboardsAllArgumentsObject $argsObject = null)
    {
        $object = new ContributorLeaderboardConnectionQueryObject("all");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectAllTime(ContributorLeaderboardsAllTimeArgumentsObject $argsObject = null)
    {
        $object = new ContributorLeaderboardQueryObject("allTime");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectMonth(ContributorLeaderboardsMonthArgumentsObject $argsObject = null)
    {
        $object = new ContributorLeaderboardQueryObject("month");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectMonths(ContributorLeaderboardsMonthsArgumentsObject $argsObject = null)
    {
        $object = new ContributorLeaderboardConnectionQueryObject("months");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectYear(ContributorLeaderboardsYearArgumentsObject $argsObject = null)
    {
        $object = new ContributorLeaderboardQueryObject("year");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectYears(ContributorLeaderboardsYearsArgumentsObject $argsObject = null)
    {
        $object = new ContributorLeaderboardConnectionQueryObject("years");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
