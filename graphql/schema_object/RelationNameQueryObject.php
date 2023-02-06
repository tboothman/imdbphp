<?php

namespace GraphQL\SchemaObject;

class RelationNameQueryObject extends QueryObject
{
    const OBJECT_NAME = "RelationName";

    public function selectDisplayableProperty(RelationNameDisplayablePropertyArgumentsObject $argsObject = null)
    {
        $object = new DisplayableRelationNamePropertyQueryObject("displayableProperty");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectName(RelationNameNameArgumentsObject $argsObject = null)
    {
        $object = new NameQueryObject("name");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNameText()
    {
        $this->selectField("nameText");

        return $this;
    }
}
