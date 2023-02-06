<?php

namespace GraphQL\SchemaObject;

class NewsSourceQueryObject extends QueryObject
{
    const OBJECT_NAME = "NewsSource";

    public function selectDescription()
    {
        $this->selectField("description");

        return $this;
    }

    public function selectHomepage(NewsSourceHomepageArgumentsObject $argsObject = null)
    {
        $object = new NewsLinkQueryObject("homepage");
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
}
