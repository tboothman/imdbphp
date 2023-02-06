<?php

namespace GraphQL\SchemaObject;

class TitleTypeSummaryQueryObject extends QueryObject
{
    const OBJECT_NAME = "TitleTypeSummary";

    public function selectTitleType(TitleTypeSummaryTitleTypeArgumentsObject $argsObject = null)
    {
        $object = new TitleTypeQueryObject("titleType");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTotal()
    {
        $this->selectField("total");

        return $this;
    }
}
