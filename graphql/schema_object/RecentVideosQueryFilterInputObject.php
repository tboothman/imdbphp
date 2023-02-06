<?php

namespace GraphQL\SchemaObject;

class RecentVideosQueryFilterInputObject extends InputObject
{
    protected $contentTypes;

    public function setContentTypes(array $contentTypes)
    {
        $this->contentTypes = $contentTypes;

        return $this;
    }
}
