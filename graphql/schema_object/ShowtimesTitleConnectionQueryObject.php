<?php

namespace GraphQL\SchemaObject;

class ShowtimesTitleConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "ShowtimesTitleConnection";

    public function selectEdges(ShowtimesTitleConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new ShowtimesTitleEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(ShowtimesTitleConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
