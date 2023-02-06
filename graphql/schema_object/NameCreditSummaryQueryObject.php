<?php

namespace GraphQL\SchemaObject;

class NameCreditSummaryQueryObject extends QueryObject
{
    const OBJECT_NAME = "NameCreditSummary";

    public function selectCategories(NameCreditSummaryCategoriesArgumentsObject $argsObject = null)
    {
        $object = new CreditCategorySummaryQueryObject("categories");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectGenres(NameCreditSummaryGenresArgumentsObject $argsObject = null)
    {
        $object = new GenreSummaryQueryObject("genres");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTitleTypeCategories(NameCreditSummaryTitleTypeCategoriesArgumentsObject $argsObject = null)
    {
        $object = new TitleTypeCategorySummaryQueryObject("titleTypeCategories");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTitleTypes(NameCreditSummaryTitleTypesArgumentsObject $argsObject = null)
    {
        $object = new TitleTypeSummaryQueryObject("titleTypes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
