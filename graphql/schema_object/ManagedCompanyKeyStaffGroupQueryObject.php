<?php

namespace GraphQL\SchemaObject;

class ManagedCompanyKeyStaffGroupQueryObject extends QueryObject
{
    const OBJECT_NAME = "ManagedCompanyKeyStaffGroup";

    public function selectAutomatic(ManagedCompanyKeyStaffGroupAutomaticArgumentsObject $argsObject = null)
    {
        $object = new ManagedCompanyKeyStaffCategoryQueryObject("automatic");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectAutomaticHistory(ManagedCompanyKeyStaffGroupAutomaticHistoryArgumentsObject $argsObject = null)
    {
        $object = new ManagedCompanyKeyStaffHistoryQueryObject("automaticHistory");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectCustom(ManagedCompanyKeyStaffGroupCustomArgumentsObject $argsObject = null)
    {
        $object = new ManagedCompanyKeyStaffCategoryQueryObject("custom");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectCustomHistory(ManagedCompanyKeyStaffGroupCustomHistoryArgumentsObject $argsObject = null)
    {
        $object = new ManagedCompanyKeyStaffHistoryQueryObject("customHistory");
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
