<?php

namespace GraphQL\SchemaObject;

class VideoContentTypeQueryObject extends QueryObject
{
    const OBJECT_NAME = "VideoContentType";

    public function selectDisplayName(VideoContentTypeDisplayNameArgumentsObject $argsObject = null)
    {
        $object = new LocalizedStringQueryObject("displayName");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }
}
