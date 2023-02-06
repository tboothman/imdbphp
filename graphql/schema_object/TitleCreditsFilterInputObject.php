<?php

namespace GraphQL\SchemaObject;

class TitleCreditsFilterInputObject extends InputObject
{
    protected $categories;
    protected $credited;
    protected $excludeCategories;
    protected $excludePrincipal;
    protected $names;

    public function setCategories(array $categories)
    {
        $this->categories = $categories;

        return $this;
    }

    public function setCredited($credited)
    {
        $this->credited = $credited;

        return $this;
    }

    public function setExcludeCategories(array $excludeCategories)
    {
        $this->excludeCategories = $excludeCategories;

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
