<?php

namespace GraphQL\SchemaObject;

class ManagedCompanyKnownForTitleGroupQueryObject extends QueryObject
{
    const OBJECT_NAME = "ManagedCompanyKnownForTitleGroup";

    public function selectAutomatic(ManagedCompanyKnownForTitleGroupAutomaticArgumentsObject $argsObject = null)
    {
        $object = new ManagedCompanyKnownForTitleCategoryQueryObject("automatic");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectAutomaticHistory(ManagedCompanyKnownForTitleGroupAutomaticHistoryArgumentsObject $argsObject = null)
    {
        $object = new ManagedCompanyKnownForTitleHistoryQueryObject("automaticHistory");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectCustom(ManagedCompanyKnownForTitleGroupCustomArgumentsObject $argsObject = null)
    {
        $object = new ManagedCompanyKnownForTitleCategoryQueryObject("custom");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectCustomHistory(ManagedCompanyKnownForTitleGroupCustomHistoryArgumentsObject $argsObject = null)
    {
        $object = new ManagedCompanyKnownForTitleHistoryQueryObject("customHistory");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectSourcePreference()
    {
        $this->selectField("sourcePreference");

        return $this;
    }
}
