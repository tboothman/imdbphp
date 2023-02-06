<?php

namespace GraphQL\SchemaObject;

class VideoMediaQueryObject extends QueryObject
{
    const OBJECT_NAME = "VideoMedia";

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectName(VideoMediaNameArgumentsObject $argsObject = null)
    {
        $object = new LocalizedStringQueryObject("name");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPrimaryImage(VideoMediaPrimaryImageArgumentsObject $argsObject = null)
    {
        $object = new MediaServiceImageQueryObject("primaryImage");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectRuntime(VideoMediaRuntimeArgumentsObject $argsObject = null)
    {
        $object = new VideoRuntimeQueryObject("runtime");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
