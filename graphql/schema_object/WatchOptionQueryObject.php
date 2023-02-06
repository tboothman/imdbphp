<?php

namespace GraphQL\SchemaObject;

class WatchOptionQueryObject extends QueryObject
{
    const OBJECT_NAME = "WatchOption";

    public function selectDescription(WatchOptionDescriptionArgumentsObject $argsObject = null)
    {
        $object = new LocalizedStringQueryObject("description");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectLink()
    {
        $this->selectField("link");

        return $this;
    }

    public function selectPromoted()
    {
        $this->selectField("promoted");

        return $this;
    }

    public function selectProvider(WatchOptionProviderArgumentsObject $argsObject = null)
    {
        $object = new WatchProviderQueryObject("provider");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectProviderName(WatchOptionProviderNameArgumentsObject $argsObject = null)
    {
        $object = new LocalizedStringQueryObject("providerName");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectProviderRefTagFragment()
    {
        $this->selectField("providerRefTagFragment");

        return $this;
    }

    public function selectShortTitle(WatchOptionShortTitleArgumentsObject $argsObject = null)
    {
        $object = new LocalizedStringQueryObject("shortTitle");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTitle(WatchOptionTitleArgumentsObject $argsObject = null)
    {
        $object = new LocalizedStringQueryObject("title");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
