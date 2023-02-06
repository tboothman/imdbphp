<?php

namespace GraphQL\SchemaObject;

class ExternalLinkCategoryWithExternalLinksExternalLinksArgumentsObject extends ArgumentsObject
{
    protected $first;

    public function setFirst($first)
    {
        $this->first = $first;

        return $this;
    }
}
