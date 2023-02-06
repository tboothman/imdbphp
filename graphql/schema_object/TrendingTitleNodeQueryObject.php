<?php

namespace GraphQL\SchemaObject;

class TrendingTitleNodeQueryObject extends QueryObject
{
    const OBJECT_NAME = "TrendingTitleNode";

    public function selectItem(TrendingTitleNodeItemArgumentsObject $argsObject = null)
    {
        $object = new TitleQueryObject("item");
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

    public function selectWeightRank()
    {
        $this->selectField("weightRank");

        return $this;
    }
}
