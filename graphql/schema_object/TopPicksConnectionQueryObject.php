<?php

namespace GraphQL\SchemaObject;

class TopPicksConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "TopPicksConnection";

    public function selectEdges(TopPicksConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new TopPicksEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(TopPicksConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectRefTag(TopPicksConnectionRefTagArgumentsObject $argsObject = null)
    {
        $object = new RefTagQueryObject("refTag");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
