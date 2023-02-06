<?php

namespace GraphQL\SchemaObject;

class RankedLifetimeBoxOfficeGrossConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "RankedLifetimeBoxOfficeGrossConnection";

    public function selectEdges(RankedLifetimeBoxOfficeGrossConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new RankedLifetimeBoxOfficeGrossEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(RankedLifetimeBoxOfficeGrossConnectionPageInfoArgumentsObject $argsObject = null)
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
