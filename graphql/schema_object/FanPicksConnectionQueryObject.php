<?php

namespace GraphQL\SchemaObject;

class FanPicksConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "FanPicksConnection";

    public function selectEdges(FanPicksConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new FanPicksEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(FanPicksConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectRefTag(FanPicksConnectionRefTagArgumentsObject $argsObject = null)
    {
        $object = new RefTagQueryObject("refTag");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
