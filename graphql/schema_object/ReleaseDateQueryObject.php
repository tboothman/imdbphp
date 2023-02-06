<?php

namespace GraphQL\SchemaObject;

class ReleaseDateQueryObject extends QueryObject
{
    const OBJECT_NAME = "ReleaseDate";

    public function selectAttributes(ReleaseDateAttributesArgumentsObject $argsObject = null)
    {
        $object = new DisplayableAttributeQueryObject("attributes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectCountry(ReleaseDateCountryArgumentsObject $argsObject = null)
    {
        $object = new LocalizedDisplayableCountryQueryObject("country");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectDay()
    {
        $this->selectField("day");

        return $this;
    }

    public function selectDisplayableProperty(ReleaseDateDisplayablePropertyArgumentsObject $argsObject = null)
    {
        $object = new DisplayableTitleReleaseDatePropertyQueryObject("displayableProperty");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectMonth()
    {
        $this->selectField("month");

        return $this;
    }

    public function selectRestriction(ReleaseDateRestrictionArgumentsObject $argsObject = null)
    {
        $object = new ReleaseDateRestrictionQueryObject("restriction");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectYear()
    {
        $this->selectField("year");

        return $this;
    }
}
