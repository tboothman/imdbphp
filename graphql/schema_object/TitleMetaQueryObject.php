<?php

namespace GraphQL\SchemaObject;

class TitleMetaQueryObject extends QueryObject
{
    const OBJECT_NAME = "TitleMeta";

    public function selectCanonicalId()
    {
        $this->selectField("canonicalId");

        return $this;
    }

    public function selectPublicationStatus()
    {
        $this->selectField("publicationStatus");

        return $this;
    }

    public function selectRestrictions(TitleMetaRestrictionsArgumentsObject $argsObject = null)
    {
        $object = new TitleMetaRestrictionsQueryObject("restrictions");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
