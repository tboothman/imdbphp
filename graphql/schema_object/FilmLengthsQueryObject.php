<?php

namespace GraphQL\SchemaObject;

class FilmLengthsQueryObject extends QueryObject
{
    const OBJECT_NAME = "FilmLengths";

    public function selectItems(FilmLengthsItemsArgumentsObject $argsObject = null)
    {
        $object = new FilmLengthQueryObject("items");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectRestriction(FilmLengthsRestrictionArgumentsObject $argsObject = null)
    {
        $object = new TechnicalSpecificationsRestrictionQueryObject("restriction");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTotal()
    {
        $this->selectField("total");

        return $this;
    }
}
