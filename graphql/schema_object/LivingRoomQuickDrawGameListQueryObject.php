<?php

namespace GraphQL\SchemaObject;

class LivingRoomQuickDrawGameListQueryObject extends QueryObject
{
    const OBJECT_NAME = "LivingRoomQuickDrawGameList";

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectName(LivingRoomQuickDrawGameListNameArgumentsObject $argsObject = null)
    {
        $object = new LivingRoomQuickDrawNameQueryObject("name");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectSlotPosition()
    {
        $this->selectField("slotPosition");

        return $this;
    }

    public function selectSponsor(LivingRoomQuickDrawGameListSponsorArgumentsObject $argsObject = null)
    {
        $object = new LivingRoomQuickDrawListSponsorQueryObject("sponsor");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTitleType(LivingRoomQuickDrawGameListTitleTypeArgumentsObject $argsObject = null)
    {
        $object = new LivingRoomListGameTitleTypeQueryObject("titleType");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTitles(LivingRoomQuickDrawGameListTitlesArgumentsObject $argsObject = null)
    {
        $object = new LivingRoomListGameTitleConnectionQueryObject("titles");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
