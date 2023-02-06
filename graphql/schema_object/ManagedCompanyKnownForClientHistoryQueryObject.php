<?php

namespace GraphQL\SchemaObject;

class ManagedCompanyKnownForClientHistoryQueryObject extends QueryObject
{
    const OBJECT_NAME = "ManagedCompanyKnownForClientHistory";

    public function selectClientHistory(ManagedCompanyKnownForClientHistoryClientHistoryArgumentsObject $argsObject = null)
    {
        $object = new ManagedCompanyKnownForClientHistoryConnectionQueryObject("clientHistory");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
