<?php

namespace GraphQL\SchemaObject;

class TaglineQueryObject extends QueryObject
{
    const OBJECT_NAME = "Tagline";

    public function selectDisplayableProperty(TaglineDisplayablePropertyArgumentsObject $argsObject = null)
    {
        $object = new DisplayableTitleTaglinePropertyQueryObject("displayableProperty");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectText()
    {
        $this->selectField("text");

        return $this;
    }
}
