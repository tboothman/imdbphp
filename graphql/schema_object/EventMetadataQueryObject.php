<?php

namespace GraphQL\SchemaObject;

class EventMetadataQueryObject extends QueryObject
{
    const OBJECT_NAME = "EventMetadata";

    public function selectEvents(EventMetadataEventsArgumentsObject $argsObject = null)
    {
        $object = new EventConnectionQueryObject("events");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
