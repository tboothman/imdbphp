<?php

namespace GraphQL\SchemaObject;

class MetacriticReviewConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "MetacriticReviewConnection";

    public function selectEdges(MetacriticReviewConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new MetacriticReviewEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(MetacriticReviewConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
