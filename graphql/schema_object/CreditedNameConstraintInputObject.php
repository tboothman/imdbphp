<?php

namespace GraphQL\SchemaObject;

class CreditedNameConstraintInputObject extends InputObject
{
    protected $allNameIds;
    protected $anyNameIds;

    public function setAllNameIds(array $allNameIds)
    {
        $this->allNameIds = $allNameIds;

        return $this;
    }

    public function setAnyNameIds(array $anyNameIds)
    {
        $this->anyNameIds = $anyNameIds;

        return $this;
    }
}
