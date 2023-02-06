<?php

namespace GraphQL\SchemaObject;

class ListQueryObject extends QueryObject
{
    const OBJECT_NAME = "List";

    public function selectAreElementsInList(ListAreElementsInListArgumentsObject $argsObject = null)
    {
        $object = new IsElementInListQueryObject("areElementsInList");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectAuthor(ListAuthorArgumentsObject $argsObject = null)
    {
        $object = new UserProfileQueryObject("author");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectCreatedDate()
    {
        $this->selectField("createdDate");

        return $this;
    }

    public function selectDescription(ListDescriptionArgumentsObject $argsObject = null)
    {
        $object = new ListDescriptionQueryObject("description");
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

    public function selectIsElementInList()
    {
        $this->selectField("isElementInList");

        return $this;
    }

    public function selectItems(ListItemsArgumentsObject $argsObject = null)
    {
        $object = new ListConnectionQueryObject("items");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectLastModifiedDate()
    {
        $this->selectField("lastModifiedDate");

        return $this;
    }

    public function selectListClass(ListListClassArgumentsObject $argsObject = null)
    {
        $object = new ListClassQueryObject("listClass");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectListType(ListListTypeArgumentsObject $argsObject = null)
    {
        $object = new ListTypeQueryObject("listType");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectName(ListNameArgumentsObject $argsObject = null)
    {
        $object = new ListNameQueryObject("name");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPrimaryImage(ListPrimaryImageArgumentsObject $argsObject = null)
    {
        $object = new ListPrimaryImageQueryObject("primaryImage");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
