<?php

namespace GraphQL\SchemaObject;

class CompanyKnownForClientQueryObject extends QueryObject
{
    const OBJECT_NAME = "CompanyKnownForClient";

    public function selectName(CompanyKnownForClientNameArgumentsObject $argsObject = null)
    {
        $object = new NameQueryObject("name");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectSummary(CompanyKnownForClientSummaryArgumentsObject $argsObject = null)
    {
        $object = new CompanyKnownForClientSummaryQueryObject("summary");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
