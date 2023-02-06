<?php

namespace GraphQL\SchemaObject;

class NameMetadataQueryObject extends QueryObject
{
    const OBJECT_NAME = "NameMetadata";

    public function selectNameCreditCategories(NameMetadataNameCreditCategoriesArgumentsObject $argsObject = null)
    {
        $object = new NameCreditCategoryQueryObject("nameCreditCategories");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
