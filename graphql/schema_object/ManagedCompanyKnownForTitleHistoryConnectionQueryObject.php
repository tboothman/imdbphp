<?php

namespace GraphQL\SchemaObject;

class ManagedCompanyKnownForTitleHistoryConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "ManagedCompanyKnownForTitleHistoryConnection";

    public function selectEdges(ManagedCompanyKnownForTitleHistoryConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new CompanyKnownForTitleVersionEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(ManagedCompanyKnownForTitleHistoryConnectionPageInfoArgumentsObject $argsObject = null)
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
