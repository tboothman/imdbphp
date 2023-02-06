<?php

namespace GraphQL\SchemaObject;

class NameExternalLinkCategoriesArgumentsObject extends ArgumentsObject
{
    protected $filter;

    public function setFilter(ExternalLinksFilterInputObject $externalLinksFilterInputObject)
    {
        $this->filter = $externalLinksFilterInputObject;

        return $this;
    }
}
