<?php

namespace GraphQL\SchemaObject;

class CompanyKnownForTitleQueryObject extends QueryObject
{
    const OBJECT_NAME = "CompanyKnownForTitle";

    public function selectSummary(CompanyKnownForTitleSummaryArgumentsObject $argsObject = null)
    {
        $object = new CompanyKnownForTitleSummaryQueryObject("summary");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTitle(CompanyKnownForTitleTitleArgumentsObject $argsObject = null)
    {
        $object = new TitleQueryObject("title");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
