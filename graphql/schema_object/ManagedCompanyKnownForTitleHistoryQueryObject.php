<?php

namespace GraphQL\SchemaObject;

class ManagedCompanyKnownForTitleHistoryQueryObject extends QueryObject
{
    const OBJECT_NAME = "ManagedCompanyKnownForTitleHistory";

    public function selectTitleHistory(ManagedCompanyKnownForTitleHistoryTitleHistoryArgumentsObject $argsObject = null)
    {
        $object = new ManagedCompanyKnownForTitleHistoryConnectionQueryObject("titleHistory");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
