<?php

namespace GraphQL\SchemaObject;

class TopRankingQueryObject extends QueryObject
{
    const OBJECT_NAME = "TopRanking";

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectRank()
    {
        $this->selectField("rank");

        return $this;
    }

    public function selectText(TopRankingTextArgumentsObject $argsObject = null)
    {
        $object = new LocalizedStringQueryObject("text");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
