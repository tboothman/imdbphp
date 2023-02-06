<?php

namespace GraphQL\SchemaObject;

class LivingRoomLobbyQueryObject extends QueryObject
{
    const OBJECT_NAME = "LivingRoomLobby";

    public function selectGames(LivingRoomLobbyGamesArgumentsObject $argsObject = null)
    {
        $object = new LivingRoomGameConnectionQueryObject("games");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
