<?php

namespace GraphQL\SchemaObject;

class NameOtherWorkQueryObject extends QueryObject
{
    const OBJECT_NAME = "NameOtherWork";

    public function selectCategory(NameOtherWorkCategoryArgumentsObject $argsObject = null)
    {
        $object = new NameOtherWorkCategoryQueryObject("category");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectDisplayableProperty(NameOtherWorkDisplayablePropertyArgumentsObject $argsObject = null)
    {
        $object = new DisplayableNameOtherWorkPropertyQueryObject("displayableProperty");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectFromDate()
    {
        $this->selectField("fromDate");

        return $this;
    }

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectText(NameOtherWorkTextArgumentsObject $argsObject = null)
    {
        $object = new MarkdownQueryObject("text");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectToDate()
    {
        $this->selectField("toDate");

        return $this;
    }
}
