<?php

namespace GraphQL\SchemaObject;

class VanityUrlQueryObject extends QueryObject
{
    const OBJECT_NAME = "VanityUrl";

    public function selectLabel()
    {
        $this->selectField("label");

        return $this;
    }

    public function selectName(VanityUrlNameArgumentsObject $argsObject = null)
    {
        $object = new NameQueryObject("name");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectUrl()
    {
        $this->selectField("url");

        return $this;
    }

    public function selectUrlPath()
    {
        $this->selectField("urlPath");

        return $this;
    }
}
