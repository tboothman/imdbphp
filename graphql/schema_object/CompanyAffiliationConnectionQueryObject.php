<?php

namespace GraphQL\SchemaObject;

class CompanyAffiliationConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "CompanyAffiliationConnection";

    public function selectEdges(CompanyAffiliationConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new CompanyAffiliationEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(CompanyAffiliationConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
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
