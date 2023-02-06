<?php

namespace GraphQL\SchemaObject;

class DisplayableNameDeathCauseQueryObject extends QueryObject
{
    const OBJECT_NAME = "DisplayableNameDeathCause";

    public function selectDisplayableProperty(DisplayableNameDeathCauseDisplayablePropertyArgumentsObject $argsObject = null)
    {
        $object = new DisplayableNameDeathCausePropertyQueryObject("displayableProperty");
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
