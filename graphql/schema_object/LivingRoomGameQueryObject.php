<?php

namespace GraphQL\SchemaObject;

class LivingRoomGameQueryObject extends QueryObject
{
    const OBJECT_NAME = "LivingRoomGame";

    public function selectAssets(LivingRoomGameAssetsArgumentsObject $argsObject = null)
    {
        $object = new LivingRoomGameAssetsQueryObject("assets");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectDescription(LivingRoomGameDescriptionArgumentsObject $argsObject = null)
    {
        $object = new LivingRoomGameDescriptionQueryObject("description");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectEstimatedTimeInSeconds()
    {
        $this->selectField("estimatedTimeInSeconds");

        return $this;
    }

    public function selectGameType()
    {
        $this->selectField("gameType");

        return $this;
    }

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectInputMethod()
    {
        $this->selectField("inputMethod");

        return $this;
    }

    public function selectMaximumNumberOfPlayers()
    {
        $this->selectField("maximumNumberOfPlayers");

        return $this;
    }

    public function selectMinimumNumberOfPlayers()
    {
        $this->selectField("minimumNumberOfPlayers");

        return $this;
    }

    public function selectName(LivingRoomGameNameArgumentsObject $argsObject = null)
    {
        $object = new LivingRoomGameNameQueryObject("name");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPickTypes(LivingRoomGamePickTypesArgumentsObject $argsObject = null)
    {
        $object = new LivingRoomGamePickTitleTypesQueryObject("pickTypes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTags(LivingRoomGameTagsArgumentsObject $argsObject = null)
    {
        $object = new LivingRoomGameTagQueryObject("tags");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
