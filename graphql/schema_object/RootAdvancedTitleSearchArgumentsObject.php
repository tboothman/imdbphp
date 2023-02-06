<?php

namespace GraphQL\SchemaObject;

class RootAdvancedTitleSearchArgumentsObject extends ArgumentsObject
{
    protected $after;
    protected $constraints;
    protected $first;
    protected $sort;

    public function setAfter($after)
    {
        $this->after = $after;

        return $this;
    }

    public function setConstraints(AdvancedTitleSearchConstraintsInputObject $advancedTitleSearchConstraintsInputObject)
    {
        $this->constraints = $advancedTitleSearchConstraintsInputObject;

        return $this;
    }

    public function setFirst($first)
    {
        $this->first = $first;

        return $this;
    }

    public function setSort(AdvancedTitleSearchSortInputObject $advancedTitleSearchSortInputObject)
    {
        $this->sort = $advancedTitleSearchSortInputObject;

        return $this;
    }
}
