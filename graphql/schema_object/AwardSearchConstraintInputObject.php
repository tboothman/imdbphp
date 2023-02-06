<?php

namespace GraphQL\SchemaObject;

class AwardSearchConstraintInputObject extends InputObject
{
    protected $allEventNominations;
    protected $anyEventNominations;

    public function setAllEventNominations(array $allEventNominations)
    {
        $this->allEventNominations = $allEventNominations;

        return $this;
    }

    public function setAnyEventNominations(array $anyEventNominations)
    {
        $this->anyEventNominations = $anyEventNominations;

        return $this;
    }
}
