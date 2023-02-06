<?php

namespace GraphQL\SchemaObject;

class StreamingTitleQueryObject extends QueryObject
{
    const OBJECT_NAME = "StreamingTitle";

    public function selectRefTag()
    {
        $this->selectField("refTag");

        return $this;
    }

    public function selectTitle(StreamingTitleTitleArgumentsObject $argsObject = null)
    {
        $object = new TitleQueryObject("title");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
