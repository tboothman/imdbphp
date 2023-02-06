<?php

namespace GraphQL\SchemaObject;

class CompanyKnownForClientSummaryQueryObject extends QueryObject
{
    const OBJECT_NAME = "CompanyKnownForClientSummary";

    public function selectRepresentation(CompanyKnownForClientSummaryRepresentationArgumentsObject $argsObject = null)
    {
        $object = new CompanyRepresentationCategoryQueryObject("representation");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectRepresentationCategories(CompanyKnownForClientSummaryRepresentationCategoriesArgumentsObject $argsObject = null)
    {
        $object = new CompanyRepresentationCategoriesQueryObject("representationCategories");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
