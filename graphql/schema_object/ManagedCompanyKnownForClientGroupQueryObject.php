<?php

namespace GraphQL\SchemaObject;

class ManagedCompanyKnownForClientGroupQueryObject extends QueryObject
{
    const OBJECT_NAME = "ManagedCompanyKnownForClientGroup";

    public function selectAutomatic(ManagedCompanyKnownForClientGroupAutomaticArgumentsObject $argsObject = null)
    {
        $object = new ManagedCompanyKnownForClientCategoryQueryObject("automatic");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectAutomaticHistory(ManagedCompanyKnownForClientGroupAutomaticHistoryArgumentsObject $argsObject = null)
    {
        $object = new ManagedCompanyKnownForClientHistoryQueryObject("automaticHistory");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectCustom(ManagedCompanyKnownForClientGroupCustomArgumentsObject $argsObject = null)
    {
        $object = new ManagedCompanyKnownForClientCategoryQueryObject("custom");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectCustomHistory(ManagedCompanyKnownForClientGroupCustomHistoryArgumentsObject $argsObject = null)
    {
        $object = new ManagedCompanyKnownForClientHistoryQueryObject("customHistory");
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
