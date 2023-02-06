<?php

namespace GraphQL\SchemaObject;

class OpeningWeekendGrossQueryObject extends QueryObject
{
    const OBJECT_NAME = "OpeningWeekendGross";

    public function selectGross(OpeningWeekendGrossGrossArgumentsObject $argsObject = null)
    {
        $object = new BoxOfficeGrossQueryObject("gross");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTheaterCount()
    {
        $this->selectField("theaterCount");

        return $this;
    }

    public function selectWeekendEndDate()
    {
        $this->selectField("weekendEndDate");

        return $this;
    }

    public function selectWeekendStartDate()
    {
        $this->selectField("weekendStartDate");

        return $this;
    }
}
