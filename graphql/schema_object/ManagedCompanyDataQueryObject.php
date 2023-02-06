<?php

namespace GraphQL\SchemaObject;

class ManagedCompanyDataQueryObject extends QueryObject
{
    const OBJECT_NAME = "ManagedCompanyData";

    public function selectKnownFor(ManagedCompanyDataKnownForArgumentsObject $argsObject = null)
    {
        $object = new ManagedCompanyKnownForGroupQueryObject("knownFor");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
