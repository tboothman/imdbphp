<?php

namespace GraphQL\SchemaObject;

class TitleCreditCategoryWithCreditsFilterInputObject extends InputObject
{
    protected $credited;
    protected $excludePrincipal;
    protected $names;

    public function setCredited($credited)
    {
        $this->credited = $credited;

        return $this;
    }

    public function setExcludePrincipal($excludePrincipal)
    {
        $this->excludePrincipal = $excludePrincipal;

        return $this;
    }

    public function setNames(array $names)
    {
        $this->names = $names;

        return $this;
    }
}
