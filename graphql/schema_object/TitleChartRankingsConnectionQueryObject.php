<?php

namespace GraphQL\SchemaObject;

class TitleChartRankingsConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "TitleChartRankingsConnection";

    public function selectEdges(TitleChartRankingsConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new TitleChartRankingsEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectMetadata(TitleChartRankingsConnectionMetadataArgumentsObject $argsObject = null)
    {
        $object = new TitleChartMetadataQueryObject("metadata");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(TitleChartRankingsConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
