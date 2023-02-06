<?php

namespace GraphQL\SchemaObject;

class TitleChartMetadataQueryObject extends QueryObject
{
    const OBJECT_NAME = "TitleChartMetadata";

    public function selectChartDescription(TitleChartMetadataChartDescriptionArgumentsObject $argsObject = null)
    {
        $object = new LocalizedStringQueryObject("chartDescription");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectChartName(TitleChartMetadataChartNameArgumentsObject $argsObject = null)
    {
        $object = new LocalizedStringQueryObject("chartName");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
