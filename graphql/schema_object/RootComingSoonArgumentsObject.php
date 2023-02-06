<?php

namespace GraphQL\SchemaObject;

use GraphQL\RawObject;

class RootComingSoonArgumentsObject extends ArgumentsObject
{
    protected $after;
    protected $comingSoonType;
    protected $disablePopularityFilter;
    protected $first;
    protected $regionOverride;
    protected $releasingOnOrAfter;
    protected $releasingOnOrBefore;
    protected $sort;

    public function setAfter($after)
    {
        $this->after = $after;

        return $this;
    }

    public function setComingSoonType($comingSoonType)
    {
        $this->comingSoonType = new RawObject($comingSoonType);

        return $this;
    }

    public function setDisablePopularityFilter($disablePopularityFilter)
    {
        $this->disablePopularityFilter = $disablePopularityFilter;

        return $this;
    }

    public function setFirst($first)
    {
        $this->first = $first;

        return $this;
    }

    public function setRegionOverride($regionOverride)
    {
        $this->regionOverride = $regionOverride;

        return $this;
    }

    public function setReleasingOnOrAfter($releasingOnOrAfter)
    {
        $this->releasingOnOrAfter = $releasingOnOrAfter;

        return $this;
    }

    public function setReleasingOnOrBefore($releasingOnOrBefore)
    {
        $this->releasingOnOrBefore = $releasingOnOrBefore;

        return $this;
    }

    public function setSort(array $sort)
    {
        $this->sort = $sort;

        return $this;
    }
}
