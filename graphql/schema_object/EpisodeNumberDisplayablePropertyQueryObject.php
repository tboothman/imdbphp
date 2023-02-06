<?php

namespace GraphQL\SchemaObject;

class EpisodeNumberDisplayablePropertyQueryObject extends QueryObject
{
    const OBJECT_NAME = "EpisodeNumberDisplayableProperty";

    public function selectValue(EpisodeNumberDisplayablePropertyValueArgumentsObject $argsObject = null)
    {
        $object = new MarkdownQueryObject("value");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
