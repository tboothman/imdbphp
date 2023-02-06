<?php

namespace GraphQL\SchemaObject;

class AspectRatioQueryObject extends QueryObject
{
    const OBJECT_NAME = "AspectRatio";

    public function selectAspectRatio()
    {
        $this->selectField("aspectRatio");

        return $this;
    }

    public function selectAttributes(AspectRatioAttributesArgumentsObject $argsObject = null)
    {
        $object = new DisplayableAttributeQueryObject("attributes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectDisplayableProperty(AspectRatioDisplayablePropertyArgumentsObject $argsObject = null)
    {
        $object = new DisplayableTechnicalSpecificationPropertyQueryObject("displayableProperty");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
