<?php

namespace GraphQL\SchemaObject;

class WatchProviderLogosQueryObject extends QueryObject
{
    const OBJECT_NAME = "WatchProviderLogos";

    public function selectIcon(WatchProviderLogosIconArgumentsObject $argsObject = null)
    {
        $object = new MediaServiceImageQueryObject("icon");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectSlate(WatchProviderLogosSlateArgumentsObject $argsObject = null)
    {
        $object = new MediaServiceImageQueryObject("slate");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
