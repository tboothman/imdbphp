<?php

namespace GraphQL\SchemaObject;

class CompanyAcronymConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "CompanyAcronymConnection";

    public function selectEdges(CompanyAcronymConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new CompanyAcronymEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(CompanyAcronymConnectionPageInfoArgumentsObject $argsObject = null)
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
