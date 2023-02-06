<?php

namespace GraphQL\SchemaObject;

class EpisodeConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "EpisodeConnection";

    public function selectEdges(EpisodeConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new EpisodeEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(EpisodeConnectionPageInfoArgumentsObject $argsObject = null)
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
