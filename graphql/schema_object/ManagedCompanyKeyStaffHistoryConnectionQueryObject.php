<?php

namespace GraphQL\SchemaObject;

class ManagedCompanyKeyStaffHistoryConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "ManagedCompanyKeyStaffHistoryConnection";

    public function selectEdges(ManagedCompanyKeyStaffHistoryConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new CompanyKeyStaffVersionEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(ManagedCompanyKeyStaffHistoryConnectionPageInfoArgumentsObject $argsObject = null)
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
