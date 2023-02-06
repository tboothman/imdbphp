<?php

namespace GraphQL\SchemaObject;

class NameKnownForQueryObject extends QueryObject
{
    const OBJECT_NAME = "NameKnownFor";

    /**
     * @deprecated Summary fields can be fetched from the credit
     */
    public function selectSummary(NameKnownForSummaryArgumentsObject $argsObject = null)
    {
        $object = new NameKnownForSummaryQueryObject("summary");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTitle(NameKnownForTitleArgumentsObject $argsObject = null)
    {
        $object = new TitleQueryObject("title");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
