<?php

namespace GraphQL\SchemaObject;

class RankedLifetimeBoxOfficeGrossQueryObject extends QueryObject
{
    const OBJECT_NAME = "RankedLifetimeBoxOfficeGross";

    public function selectBoxOfficeAreaType(RankedLifetimeBoxOfficeGrossBoxOfficeAreaTypeArgumentsObject $argsObject = null)
    {
        $object = new BoxOfficeAreaTypeQueryObject("boxOfficeAreaType");
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

    public function selectTotal(RankedLifetimeBoxOfficeGrossTotalArgumentsObject $argsObject = null)
    {
        $object = new MoneyQueryObject("total");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
