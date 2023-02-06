<?php

namespace GraphQL\SchemaObject;

class PrimaryWatchOptionQueryObject extends QueryObject
{
    const OBJECT_NAME = "PrimaryWatchOption";

    public function selectAdditionalWatchOptionsCount()
    {
        $this->selectField("additionalWatchOptionsCount");

        return $this;
    }

    public function selectWatchOption(PrimaryWatchOptionWatchOptionArgumentsObject $argsObject = null)
    {
        $object = new WatchOptionQueryObject("watchOption");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
