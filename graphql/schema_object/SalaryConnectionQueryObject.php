<?php

namespace GraphQL\SchemaObject;

class SalaryConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "SalaryConnection";

    public function selectEdges(SalaryConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new SalaryEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(SalaryConnectionPageInfoArgumentsObject $argsObject = null)
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
