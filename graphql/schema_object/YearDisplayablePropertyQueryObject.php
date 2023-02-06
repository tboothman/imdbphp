<?php

namespace GraphQL\SchemaObject;

class YearDisplayablePropertyQueryObject extends QueryObject
{
    const OBJECT_NAME = "YearDisplayableProperty";

    public function selectValue(YearDisplayablePropertyValueArgumentsObject $argsObject = null)
    {
        $object = new MarkdownQueryObject("value");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
