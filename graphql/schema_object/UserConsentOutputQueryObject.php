<?php

namespace GraphQL\SchemaObject;

class UserConsentOutputQueryObject extends QueryObject
{
    const OBJECT_NAME = "UserConsentOutput";

    public function selectConsentOperation()
    {
        $this->selectField("consentOperation");

        return $this;
    }

    public function selectConsentType()
    {
        $this->selectField("consentType");

        return $this;
    }
}
