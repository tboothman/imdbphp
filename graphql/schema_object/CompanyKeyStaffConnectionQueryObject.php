<?php

namespace GraphQL\SchemaObject;

class CompanyKeyStaffConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "CompanyKeyStaffConnection";

    public function selectEdges(CompanyKeyStaffConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new CompanyKeyStaffEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(CompanyKeyStaffConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectRecordPoolSize()
    {
        $this->selectField("recordPoolSize");

        return $this;
    }

    public function selectTotal()
    {
        $this->selectField("total");

        return $this;
    }
}
