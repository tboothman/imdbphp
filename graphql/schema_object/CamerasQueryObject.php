<?php

namespace GraphQL\SchemaObject;

class CamerasQueryObject extends QueryObject
{
    const OBJECT_NAME = "Cameras";

    public function selectItems(CamerasItemsArgumentsObject $argsObject = null)
    {
        $object = new CameraQueryObject("items");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectRestriction(CamerasRestrictionArgumentsObject $argsObject = null)
    {
        $object = new TechnicalSpecificationsRestrictionQueryObject("restriction");
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
