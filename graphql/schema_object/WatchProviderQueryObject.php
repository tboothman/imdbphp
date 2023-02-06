<?php

namespace GraphQL\SchemaObject;

class WatchProviderQueryObject extends QueryObject
{
    const OBJECT_NAME = "WatchProvider";

    public function selectDescription(WatchProviderDescriptionArgumentsObject $argsObject = null)
    {
        $object = new LocalizedStringQueryObject("description");
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

    public function selectLogos(WatchProviderLogosArgumentsObject $argsObject = null)
    {
        $object = new WatchProviderLogosQueryObject("logos");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectName(WatchProviderNameArgumentsObject $argsObject = null)
    {
        $object = new LocalizedStringQueryObject("name");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectRefTagFragment()
    {
        $this->selectField("refTagFragment");

        return $this;
    }

    public function selectWatchOptionCategoryType()
    {
        $this->selectField("watchOptionCategoryType");

        return $this;
    }
}
