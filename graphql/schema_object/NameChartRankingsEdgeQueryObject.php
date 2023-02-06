<?php

namespace GraphQL\SchemaObject;

class NameChartRankingsEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "NameChartRankingsEdge";

    public function selectNode(NameChartRankingsEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new NameChartRankingsNodeQueryObject("node");
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
