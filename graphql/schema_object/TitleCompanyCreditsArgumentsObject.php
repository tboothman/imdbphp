<?php

namespace GraphQL\SchemaObject;

class TitleCompanyCreditsArgumentsObject extends ArgumentsObject
{
    protected $after;
    protected $before;
    protected $filter;
    protected $first;
    protected $last;

    public function setAfter($after)
    {
        $this->after = $after;

        return $this;
    }

    public function setBefore($before)
    {
        $this->before = $before;

        return $this;
    }

    public function setFilter(CompanyCreditsFilterInputObject $companyCreditsFilterInputObject)
    {
        $this->filter = $companyCreditsFilterInputObject;

        return $this;
    }

    public function setFirst($first)
    {
        $this->first = $first;

        return $this;
    }

    public function setLast($last)
    {
        $this->last = $last;

        return $this;
    }
}
