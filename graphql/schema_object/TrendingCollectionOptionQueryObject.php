<?php

namespace GraphQL\SchemaObject;

class TrendingCollectionOptionQueryObject extends QueryObject
{
    const OBJECT_NAME = "TrendingCollectionOption";

    public function selectCountry(TrendingCollectionOptionCountryArgumentsObject $argsObject = null)
    {
        $object = new DisplayableCountryQueryObject("country");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectDataWindow()
    {
        $this->selectField("dataWindow");

        return $this;
    }

    /**
     * @deprecated region is deprecated. Use country instead.
     */
    public function selectRegion(TrendingCollectionOptionRegionArgumentsObject $argsObject = null)
    {
        $object = new DisplayableRegionQueryObject("region");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTrafficSource()
    {
        $this->selectField("trafficSource");

        return $this;
    }
}
