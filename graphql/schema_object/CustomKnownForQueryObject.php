<?php

namespace GraphQL\SchemaObject;

class CustomKnownForQueryObject extends QueryObject
{
    const OBJECT_NAME = "CustomKnownFor";

    public function selectIsAdminEdited()
    {
        $this->selectField("isAdminEdited");

        return $this;
    }

    public function selectIsAdminNotificationSeen()
    {
        $this->selectField("isAdminNotificationSeen");

        return $this;
    }

    public function selectIsBlocked()
    {
        $this->selectField("isBlocked");

        return $this;
    }

    public function selectIsPublished()
    {
        $this->selectField("isPublished");

        return $this;
    }

    public function selectIsReset()
    {
        $this->selectField("isReset");

        return $this;
    }

    public function selectLastEdited()
    {
        $this->selectField("lastEdited");

        return $this;
    }

    public function selectLastEditedByAdmin()
    {
        $this->selectField("lastEditedByAdmin");

        return $this;
    }

    public function selectTitles(CustomKnownForTitlesArgumentsObject $argsObject = null)
    {
        $object = new TitleQueryObject("titles");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
