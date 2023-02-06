<?php

namespace GraphQL\SchemaObject;

class CertificateQueryObject extends QueryObject
{
    const OBJECT_NAME = "Certificate";

    public function selectAttributes(CertificateAttributesArgumentsObject $argsObject = null)
    {
        $object = new DisplayableAttributeQueryObject("attributes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectCountry(CertificateCountryArgumentsObject $argsObject = null)
    {
        $object = new DisplayableCountryQueryObject("country");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectRating()
    {
        $this->selectField("rating");

        return $this;
    }

    public function selectRatingReason()
    {
        $this->selectField("ratingReason");

        return $this;
    }

    public function selectRatingsBody(CertificateRatingsBodyArgumentsObject $argsObject = null)
    {
        $object = new RatingsBodyQueryObject("ratingsBody");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
