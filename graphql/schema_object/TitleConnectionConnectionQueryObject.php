<?php

namespace GraphQL\SchemaObject;

class TitleConnectionConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "TitleConnectionConnection";

    public function selectEdges(TitleConnectionConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new TitleConnectionEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(TitleConnectionConnectionPageInfoArgumentsObject $argsObject = null)
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
