<?php

namespace GraphQL\SchemaObject;

class NamePersonalLocationsQueryObject extends QueryObject
{
    const OBJECT_NAME = "NamePersonalLocations";

    public function selectLocations(NamePersonalLocationsLocationsArgumentsObject $argsObject = null)
    {
        $object = new NamePersonalLocationQueryObject("locations");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTotal()
    {
        $this->selectField("total");

        return $this;
    }
}
