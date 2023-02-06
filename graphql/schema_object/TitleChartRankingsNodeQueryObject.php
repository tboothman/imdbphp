<?php

namespace GraphQL\SchemaObject;

class TitleChartRankingsNodeQueryObject extends QueryObject
{
    const OBJECT_NAME = "TitleChartRankingsNode";

    public function selectChartRating()
    {
        $this->selectField("chartRating");

        return $this;
    }

    public function selectChartVoteCount()
    {
        $this->selectField("chartVoteCount");

        return $this;
    }

    public function selectItem(TitleChartRankingsNodeItemArgumentsObject $argsObject = null)
    {
        $object = new TitleQueryObject("item");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
