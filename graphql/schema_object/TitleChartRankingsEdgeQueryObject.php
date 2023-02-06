<?php

namespace GraphQL\SchemaObject;

class TitleChartRankingsEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "TitleChartRankingsEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(TitleChartRankingsEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new TitleChartRankingsNodeQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPosition()
    {
        $this->selectField("position");

        return $this;
    }
}
