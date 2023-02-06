<?php

namespace GraphQL\SchemaObject;

class RootVanityUrlArgumentsObject extends ArgumentsObject
{
    protected $urlPath;

    public function setUrlPath($urlPath)
    {
        $this->urlPath = $urlPath;

        return $this;
    }
}
