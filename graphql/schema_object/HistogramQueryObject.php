<?php

namespace GraphQL\SchemaObject;

class HistogramQueryObject extends QueryObject
{
    const OBJECT_NAME = "Histogram";

    public function selectDemographic(HistogramDemographicArgumentsObject $argsObject = null)
    {
        $object = new DemographicQueryObject("demographic");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectHistogramValues(HistogramHistogramValuesArgumentsObject $argsObject = null)
    {
        $object = new HistogramValuesQueryObject("histogramValues");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
