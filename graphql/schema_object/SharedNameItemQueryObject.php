<?php

namespace GraphQL\SchemaObject;

class SharedNameItemQueryObject extends QueryObject
{
    const OBJECT_NAME = "SharedNameItem";

    public function selectDescriptions(SharedNameItemDescriptionsArgumentsObject $argsObject = null)
    {
        $object = new ConnectionDescriptionQueryObject("descriptions");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectInputSharedTitles(SharedNameItemInputSharedTitlesArgumentsObject $argsObject = null)
    {
        $object = new TitleQueryObject("inputSharedTitles");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectMutualName(SharedNameItemMutualNameArgumentsObject $argsObject = null)
    {
        $object = new NameQueryObject("mutualName");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectParentSharedTitles(SharedNameItemParentSharedTitlesArgumentsObject $argsObject = null)
    {
        $object = new TitleQueryObject("parentSharedTitles");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectScore()
    {
        $this->selectField("score");

        return $this;
    }

    public function selectTotalInputSharedTitles()
    {
        $this->selectField("totalInputSharedTitles");

        return $this;
    }

    public function selectTotalParentSharedTitles()
    {
        $this->selectField("totalParentSharedTitles");

        return $this;
    }
}
