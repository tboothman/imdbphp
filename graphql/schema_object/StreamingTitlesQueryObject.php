<?php

namespace GraphQL\SchemaObject;

class StreamingTitlesQueryObject extends QueryObject
{
    const OBJECT_NAME = "StreamingTitles";

    public function selectProvider(StreamingTitlesProviderArgumentsObject $argsObject = null)
    {
        $object = new WatchProviderQueryObject("provider");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTitles(StreamingTitlesTitlesArgumentsObject $argsObject = null)
    {
        $object = new StreamingTitleConnectionQueryObject("titles");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
