<?php

namespace GraphQL\SchemaObject;

class TitleConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "TitleConnection";

    public function selectAssociatedTitle(TitleConnectionAssociatedTitleArgumentsObject $argsObject = null)
    {
        $object = new TitleQueryObject("associatedTitle");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectCategory(TitleConnectionCategoryArgumentsObject $argsObject = null)
    {
        $object = new TitleConnectionCategoryQueryObject("category");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectText()
    {
        $this->selectField("text");

        return $this;
    }
}
