<?php

namespace GraphQL\SchemaObject;

class ManagedCompanyKnownForClientCategoryQueryObject extends QueryObject
{
    const OBJECT_NAME = "ManagedCompanyKnownForClientCategory";

    public function selectClients(ManagedCompanyKnownForClientCategoryClientsArgumentsObject $argsObject = null)
    {
        $object = new CompanyKnownForClientConnectionQueryObject("clients");
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
}
