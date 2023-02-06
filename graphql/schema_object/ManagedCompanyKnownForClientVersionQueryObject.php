<?php

namespace GraphQL\SchemaObject;

class ManagedCompanyKnownForClientVersionQueryObject extends QueryObject
{
    const OBJECT_NAME = "ManagedCompanyKnownForClientVersion";

    public function selectClients(ManagedCompanyKnownForClientVersionClientsArgumentsObject $argsObject = null)
    {
        $object = new CompanyKnownForClientConnectionQueryObject("clients");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectCreatedDate()
    {
        $this->selectField("createdDate");

        return $this;
    }

    public function selectModifiedBy(ManagedCompanyKnownForClientVersionModifiedByArgumentsObject $argsObject = null)
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

    public function selectVersionNumber()
    {
        $this->selectField("versionNumber");

        return $this;
    }
}
