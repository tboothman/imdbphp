<?php

namespace GraphQL\SchemaObject;

class NameDisplayPreferencesQueryObject extends QueryObject
{
    const OBJECT_NAME = "NameDisplayPreferences";

    public function selectAkas()
    {
        $this->selectField("akas");

        return $this;
    }

    public function selectAwards()
    {
        $this->selectField("awards");

        return $this;
    }

    public function selectBiography()
    {
        $this->selectField("biography");

        return $this;
    }

    public function selectHeight()
    {
        $this->selectField("height");

        return $this;
    }
}
