<?php

namespace GraphQL\SchemaObject;

class TechnicalSpecificationsFilterInputObject extends InputObject
{
    protected $versions;

    public function setVersions($versions)
    {
        $this->versions = $versions;

        return $this;
    }
}
