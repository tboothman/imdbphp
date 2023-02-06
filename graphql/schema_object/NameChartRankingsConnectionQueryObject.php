<?php

namespace GraphQL\SchemaObject;

class NameChartRankingsConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "NameChartRankingsConnection";

    public function selectEdges(NameChartRankingsConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new NameChartRankingsEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
