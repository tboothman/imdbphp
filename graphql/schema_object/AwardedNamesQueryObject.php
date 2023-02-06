<?php

namespace GraphQL\SchemaObject;

class AwardedNamesQueryObject extends QueryObject
{
    const OBJECT_NAME = "AwardedNames";

    public function selectNames(AwardedNamesNamesArgumentsObject $argsObject = null)
    {
        $object = new NameQueryObject("names");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectSecondaryCompanies(AwardedNamesSecondaryCompaniesArgumentsObject $argsObject = null)
    {
        $object = new CompanyQueryObject("secondaryCompanies");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectSecondaryTitles(AwardedNamesSecondaryTitlesArgumentsObject $argsObject = null)
    {
        $object = new TitleQueryObject("secondaryTitles");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
