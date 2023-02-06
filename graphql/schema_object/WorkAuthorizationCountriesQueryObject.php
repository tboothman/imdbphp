<?php

namespace GraphQL\SchemaObject;

class WorkAuthorizationCountriesQueryObject extends QueryObject
{
    const OBJECT_NAME = "WorkAuthorizationCountries";

    public function selectTotal()
    {
        $this->selectField("total");

        return $this;
    }

    public function selectWorkAuthorizations(WorkAuthorizationCountriesWorkAuthorizationsArgumentsObject $argsObject = null)
    {
        $object = new WorkAuthorizationInCountryQueryObject("workAuthorizations");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
