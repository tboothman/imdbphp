<?php

namespace GraphQL\SchemaObject;

class NameRelationsFilterInputObject extends InputObject
{
    protected $excludeRelationshipTypes;
    protected $relationshipTypes;

    public function setExcludeRelationshipTypes(array $excludeRelationshipTypes)
    {
        $this->excludeRelationshipTypes = $excludeRelationshipTypes;

        return $this;
    }

    public function setRelationshipTypes(array $relationshipTypes)
    {
        $this->relationshipTypes = $relationshipTypes;

        return $this;
    }
}
