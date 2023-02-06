<?php

namespace GraphQL\SchemaObject;

class CharacterQueryObject extends QueryObject
{
    const OBJECT_NAME = "Character";

    public function selectName()
    {
        $this->selectField("name");

        return $this;
    }
}
