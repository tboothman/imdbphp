<?php

namespace GraphQL\SchemaObject;

class CustomPrimaryProfessionsQueryObject extends QueryObject
{
    const OBJECT_NAME = "CustomPrimaryProfessions";

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

    public function selectProfessions(CustomPrimaryProfessionsProfessionsArgumentsObject $argsObject = null)
    {
        $object = new PrimaryProfessionQueryObject("professions");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
