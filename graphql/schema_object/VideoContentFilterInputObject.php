<?php

namespace GraphQL\SchemaObject;

class VideoContentFilterInputObject extends InputObject
{
    protected $definitions;
    protected $mimeTypes;

    public function setDefinitions(array $definitions)
    {
        $this->definitions = $definitions;

        return $this;
    }

    public function setMimeTypes(array $mimeTypes)
    {
        $this->mimeTypes = $mimeTypes;

        return $this;
    }
}
