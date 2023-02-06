<?php

namespace GraphQL\SchemaObject;

class NameMetaQueryObject extends QueryObject
{
    const OBJECT_NAME = "NameMeta";

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
}
