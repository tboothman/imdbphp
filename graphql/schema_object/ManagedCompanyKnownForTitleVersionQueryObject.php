<?php

namespace GraphQL\SchemaObject;

class ManagedCompanyKnownForTitleVersionQueryObject extends QueryObject
{
    const OBJECT_NAME = "ManagedCompanyKnownForTitleVersion";

    public function selectCreatedDate()
    {
        $this->selectField("createdDate");

        return $this;
    }

    public function selectModifiedBy(ManagedCompanyKnownForTitleVersionModifiedByArgumentsObject $argsObject = null)
    {
        $object = new ModifiedByQueryObject("modifiedBy");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectStatus()
    {
        $this->selectField("status");

        return $this;
    }

    public function selectTitles(ManagedCompanyKnownForTitleVersionTitlesArgumentsObject $argsObject = null)
    {
        $object = new CompanyKnownForTitleConnectionQueryObject("titles");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectVersionNumber()
    {
        $this->selectField("versionNumber");

        return $this;
    }
}
