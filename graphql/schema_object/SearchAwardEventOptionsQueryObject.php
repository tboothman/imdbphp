<?php

namespace GraphQL\SchemaObject;

class SearchAwardEventOptionsQueryObject extends QueryObject
{
    const OBJECT_NAME = "SearchAwardEventOptions";

    public function selectEvents(SearchAwardEventOptionsEventsArgumentsObject $argsObject = null)
    {
        $object = new SearchAwardEventQueryObject("events");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
