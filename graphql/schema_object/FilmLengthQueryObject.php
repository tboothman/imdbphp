<?php

namespace GraphQL\SchemaObject;

class FilmLengthQueryObject extends QueryObject
{
    const OBJECT_NAME = "FilmLength";

    public function selectAttributes(FilmLengthAttributesArgumentsObject $argsObject = null)
    {
        $object = new DisplayableAttributeQueryObject("attributes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectCountries(FilmLengthCountriesArgumentsObject $argsObject = null)
    {
        $object = new DisplayableCountryQueryObject("countries");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectDisplayableProperty(FilmLengthDisplayablePropertyArgumentsObject $argsObject = null)
    {
        $object = new DisplayableTechnicalSpecificationLocalizedPropertyQueryObject("displayableProperty");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectFilmLength()
    {
        $this->selectField("filmLength");

        return $this;
    }

    public function selectIsSplitReel()
    {
        $this->selectField("isSplitReel");

        return $this;
    }

    public function selectNumReels()
    {
        $this->selectField("numReels");

        return $this;
    }
}
