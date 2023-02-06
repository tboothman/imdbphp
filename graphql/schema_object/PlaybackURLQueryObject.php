<?php

namespace GraphQL\SchemaObject;

class PlaybackURLQueryObject extends QueryObject
{
    const OBJECT_NAME = "PlaybackURL";

    public function selectDisplayName(PlaybackURLDisplayNameArgumentsObject $argsObject = null)
    {
        $object = new LocalizedStringQueryObject("displayName");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    /**
     * @deprecated Use `videoMimeType`
     */
    public function selectMimeType()
    {
        $this->selectField("mimeType");

        return $this;
    }

    public function selectUrl()
    {
        $this->selectField("url");

        return $this;
    }

    public function selectVideoDefinition()
    {
        $this->selectField("videoDefinition");

        return $this;
    }

    public function selectVideoMimeType()
    {
        $this->selectField("videoMimeType");

        return $this;
    }
}
