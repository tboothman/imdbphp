<?php

namespace GraphQL\SchemaObject;

class AwardedTitlesQueryObject extends QueryObject
{
    const OBJECT_NAME = "AwardedTitles";

    public function selectSecondaryCompanies(AwardedTitlesSecondaryCompaniesArgumentsObject $argsObject = null)
    {
        $object = new CompanyQueryObject("secondaryCompanies");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectSecondaryNames(AwardedTitlesSecondaryNamesArgumentsObject $argsObject = null)
    {
        $object = new NameQueryObject("secondaryNames");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTitles(AwardedTitlesTitlesArgumentsObject $argsObject = null)
    {
        $object = new TitleQueryObject("titles");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
