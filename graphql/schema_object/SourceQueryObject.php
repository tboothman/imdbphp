<?php

namespace GraphQL\SchemaObject;

class SourceQueryObject extends QueryObject
{
    const OBJECT_NAME = "Source";

    public function selectAttributionUrl()
    {
        $this->selectField("attributionUrl");

        return $this;
    }

    public function selectBanner(SourceBannerArgumentsObject $argsObject = null)
    {
        $object = new BannerQueryObject("banner");
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

    public function selectText()
    {
        $this->selectField("text");

        return $this;
    }
}
