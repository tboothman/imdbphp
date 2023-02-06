<?php

namespace GraphQL\SchemaObject;

class CameraQueryObject extends QueryObject
{
    const OBJECT_NAME = "Camera";

    public function selectAttributes(CameraAttributesArgumentsObject $argsObject = null)
    {
        $object = new DisplayableAttributeQueryObject("attributes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectCamera()
    {
        $this->selectField("camera");

        return $this;
    }

    public function selectDisplayableProperty(CameraDisplayablePropertyArgumentsObject $argsObject = null)
    {
        $object = new DisplayableTechnicalSpecificationPropertyQueryObject("displayableProperty");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
