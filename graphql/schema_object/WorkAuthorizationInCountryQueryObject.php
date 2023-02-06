<?php

namespace GraphQL\SchemaObject;

class WorkAuthorizationInCountryQueryObject extends QueryObject
{
    const OBJECT_NAME = "WorkAuthorizationInCountry";

    public function selectCountry(WorkAuthorizationInCountryCountryArgumentsObject $argsObject = null)
    {
        $object = new LocalizedDisplayableCountryQueryObject("country");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectIsAuthorized()
    {
        $this->selectField("isAuthorized");

        return $this;
    }
}
