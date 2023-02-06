<?php

namespace GraphQL\SchemaObject;

class AnimatedImageQueryObject extends QueryObject
{
    const OBJECT_NAME = "AnimatedImage";

    public function selectDelayPerFrameInMilliseconds()
    {
        $this->selectField("delayPerFrameInMilliseconds");

        return $this;
    }

    public function selectFrames(AnimatedImageFramesArgumentsObject $argsObject = null)
    {
        $object = new MediaServiceImageQueryObject("frames");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
