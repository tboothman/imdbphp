<?php

namespace GraphQL\SchemaObject;

class SharedNamesResultQueryObject extends QueryObject
{
    const OBJECT_NAME = "SharedNamesResult";

    public function selectBackfillMessage(SharedNamesResultBackfillMessageArgumentsObject $argsObject = null)
    {
        $object = new BackfillMessageQueryObject("backfillMessage");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectSharedCreditCategorySummary(SharedNamesResultSharedCreditCategorySummaryArgumentsObject $argsObject = null)
    {
        $object = new SharedCreditCategorySummaryQueryObject("sharedCreditCategorySummary");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectSharedNames(SharedNamesResultSharedNamesArgumentsObject $argsObject = null)
    {
        $object = new SharedNamesConnectionQueryObject("sharedNames");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
