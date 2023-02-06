<?php

namespace GraphQL\SchemaObject;

class TitleExternalLinkCategoriesArgumentsObject extends ArgumentsObject
{
    protected $filter;

    public function setFilter(ExternalLinksFilterInputObject $externalLinksFilterInputObject)
    {
        $this->filter = $externalLinksFilterInputObject;

        return $this;
    }
}
