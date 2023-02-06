<?php

namespace GraphQL\SchemaObject;

class CompanyKnownForTitleSummaryQueryObject extends QueryObject
{
    const OBJECT_NAME = "CompanyKnownForTitleSummary";

    public function selectCountries(CompanyKnownForTitleSummaryCountriesArgumentsObject $argsObject = null)
    {
        $object = new DisplayableCountryQueryObject("countries");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectJobs(CompanyKnownForTitleSummaryJobsArgumentsObject $argsObject = null)
    {
        $object = new CompanyKnownForJobQueryObject("jobs");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectYearRange(CompanyKnownForTitleSummaryYearRangeArgumentsObject $argsObject = null)
    {
        $object = new YearRangeQueryObject("yearRange");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
