<?php

namespace GraphQL\SchemaObject;

class ManagedCompanyKnownForClientHistoryConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "ManagedCompanyKnownForClientHistoryConnection";

    public function selectEdges(ManagedCompanyKnownForClientHistoryConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new CompanyKnownForClientVersionEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(ManagedCompanyKnownForClientHistoryConnectionPageInfoArgumentsObject $argsObject = null)
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
