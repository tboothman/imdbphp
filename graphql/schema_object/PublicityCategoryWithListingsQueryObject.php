<?php

namespace GraphQL\SchemaObject;

class PublicityCategoryWithListingsQueryObject extends QueryObject
{
    const OBJECT_NAME = "PublicityCategoryWithListings";

    public function selectCategory(PublicityCategoryWithListingsCategoryArgumentsObject $argsObject = null)
    {
        $object = new PublicityListingCategoryQueryObject("category");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPublicityListings(PublicityCategoryWithListingsPublicityListingsArgumentsObject $argsObject = null)
    {
        $object = new PublicityListingConnectionQueryObject("publicityListings");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
