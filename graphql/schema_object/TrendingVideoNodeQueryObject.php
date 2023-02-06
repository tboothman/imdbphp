<?php

namespace GraphQL\SchemaObject;

class TrendingVideoNodeQueryObject extends QueryObject
{
    const OBJECT_NAME = "TrendingVideoNode";

    public function selectItem(TrendingVideoNodeItemArgumentsObject $argsObject = null)
    {
        $object = new VideoQueryObject("item");
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
