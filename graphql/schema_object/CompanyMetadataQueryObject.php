<?php

namespace GraphQL\SchemaObject;

class CompanyMetadataQueryObject extends QueryObject
{
    const OBJECT_NAME = "CompanyMetadata";

    public function selectCompanyCreditCategories(CompanyMetadataCompanyCreditCategoriesArgumentsObject $argsObject = null)
    {
        $object = new CompanyCreditCategoryQueryObject("companyCreditCategories");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
