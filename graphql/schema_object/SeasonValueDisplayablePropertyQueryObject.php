<?php

namespace GraphQL\SchemaObject;

class SeasonValueDisplayablePropertyQueryObject extends QueryObject
{
    const OBJECT_NAME = "SeasonValueDisplayableProperty";

    public function selectValue(SeasonValueDisplayablePropertyValueArgumentsObject $argsObject = null)
    {
        $object = new MarkdownQueryObject("value");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
