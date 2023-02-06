<?php

namespace GraphQL\SchemaObject;

class TitleTypeSearchConstraintInputObject extends InputObject
{
    protected $anyTitleTypeIds;

    public function setAnyTitleTypeIds(array $anyTitleTypeIds)
    {
        $this->anyTitleTypeIds = $anyTitleTypeIds;

        return $this;
    }
}
