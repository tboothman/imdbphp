<?php

namespace GraphQL\SchemaObject;

class ContributorQueryObject extends QueryObject
{
    const OBJECT_NAME = "Contributor";

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectUser(ContributorUserArgumentsObject $argsObject = null)
    {
        $object = new UserProfileQueryObject("user");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
