<?php

namespace GraphQL\SchemaObject;

class LivingRoomPassportGameListQueryObject extends QueryObject
{
    const OBJECT_NAME = "LivingRoomPassportGameList";

    public function selectDescription(LivingRoomPassportGameListDescriptionArgumentsObject $argsObject = null)
    {
        $object = new LivingRoomPassportDescriptionQueryObject("description");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectExpirationTimeInEpochSeconds()
    {
        $this->selectField("expirationTimeInEpochSeconds");

        return $this;
    }

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectName(LivingRoomPassportGameListNameArgumentsObject $argsObject = null)
    {
        $object = new LivingRoomPassportNameQueryObject("name");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTitles(LivingRoomPassportGameListTitlesArgumentsObject $argsObject = null)
    {
        $object = new LivingRoomListGameTitleConnectionQueryObject("titles");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
