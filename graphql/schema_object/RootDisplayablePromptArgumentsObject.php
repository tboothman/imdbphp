<?php

namespace GraphQL\SchemaObject;

use GraphQL\RawObject;

class RootDisplayablePromptArgumentsObject extends ArgumentsObject
{
    protected $constId;
    protected $promptType;

    public function setConstId($constId)
    {
        $this->constId = $constId;

        return $this;
    }

    public function setPromptType($promptType)
    {
        $this->promptType = new RawObject($promptType);

        return $this;
    }
}
