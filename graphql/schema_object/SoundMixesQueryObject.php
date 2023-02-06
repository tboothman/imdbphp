<?php

namespace GraphQL\SchemaObject;

class SoundMixesQueryObject extends QueryObject
{
    const OBJECT_NAME = "SoundMixes";

    public function selectItems(SoundMixesItemsArgumentsObject $argsObject = null)
    {
        $object = new SoundMixQueryObject("items");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectRestriction(SoundMixesRestrictionArgumentsObject $argsObject = null)
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
