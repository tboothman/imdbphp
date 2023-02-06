<?php

namespace GraphQL\SchemaObject;

class TrendingNameNodeQueryObject extends QueryObject
{
    const OBJECT_NAME = "TrendingNameNode";

    public function selectItem(TrendingNameNodeItemArgumentsObject $argsObject = null)
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

    public function selectWeightRank()
    {
        $this->selectField("weightRank");

        return $this;
    }
}
