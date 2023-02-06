<?php

namespace GraphQL\SchemaObject;

class AdvancedTitleSearchConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "AdvancedTitleSearchConnection";

    public function selectEdges(AdvancedTitleSearchConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new AdvancedTitleSearchEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(AdvancedTitleSearchConnectionPageInfoArgumentsObject $argsObject = null)
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
