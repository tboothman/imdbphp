<?php

namespace GraphQL\SchemaObject;

class NameChartRankingsNodeQueryObject extends QueryObject
{
    const OBJECT_NAME = "NameChartRankingsNode";

    public function selectItem(NameChartRankingsNodeItemArgumentsObject $argsObject = null)
    {
        $object = new NameQueryObject("item");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectRank()
    {
        $this->selectField("rank");

        return $this;
    }
}
