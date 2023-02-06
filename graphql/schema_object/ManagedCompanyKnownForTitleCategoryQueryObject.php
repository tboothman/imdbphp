<?php

namespace GraphQL\SchemaObject;

class ManagedCompanyKnownForTitleCategoryQueryObject extends QueryObject
{
    const OBJECT_NAME = "ManagedCompanyKnownForTitleCategory";

    public function selectStatus()
    {
        $this->selectField("status");

        return $this;
    }

    public function selectTitles(ManagedCompanyKnownForTitleCategoryTitlesArgumentsObject $argsObject = null)
    {
        $object = new CompanyKnownForTitleConnectionQueryObject("titles");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
