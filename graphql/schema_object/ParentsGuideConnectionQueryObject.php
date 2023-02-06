<?php

namespace GraphQL\SchemaObject;

class ParentsGuideConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "ParentsGuideConnection";

    public function selectEdges(ParentsGuideConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new ParentsGuideEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(ParentsGuideConnectionPageInfoArgumentsObject $argsObject = null)
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
