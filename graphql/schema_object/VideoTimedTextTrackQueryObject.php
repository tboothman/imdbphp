<?php

namespace GraphQL\SchemaObject;

class VideoTimedTextTrackQueryObject extends QueryObject
{
    const OBJECT_NAME = "VideoTimedTextTrack";

    public function selectDisplayName(VideoTimedTextTrackDisplayNameArgumentsObject $argsObject = null)
    {
        $object = new LocalizedStringQueryObject("displayName");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectLanguage()
    {
        $this->selectField("language");

        return $this;
    }

    public function selectRefTagFragment()
    {
        $this->selectField("refTagFragment");

        return $this;
    }

    public function selectUrl()
    {
        $this->selectField("url");

        return $this;
    }
}
