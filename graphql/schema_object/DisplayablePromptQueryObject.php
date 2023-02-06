<?php

namespace GraphQL\SchemaObject;

class DisplayablePromptQueryObject extends QueryObject
{
    const OBJECT_NAME = "DisplayablePrompt";

    public function selectConstId()
    {
        $this->selectField("constId");

        return $this;
    }

    public function selectDisplay()
    {
        $this->selectField("display");

        return $this;
    }

    public function selectPromptType()
    {
        $this->selectField("promptType");

        return $this;
    }
}
