<?php

namespace GraphQL\SchemaObject;

class ShowtimesTitlesQueryMetadataInputObject extends InputObject
{
    protected $dateRange;
    protected $sortField;
    protected $sortOrder;

    public function setDateRange(ShowtimesTitlesDateRangeFilterInputObject $showtimesTitlesDateRangeFilterInputObject)
    {
        $this->dateRange = $showtimesTitlesDateRangeFilterInputObject;

        return $this;
    }

    public function setSortField($sortField)
    {
        $this->sortField = $sortField;

        return $this;
    }

    public function setSortOrder($sortOrder)
    {
        $this->sortOrder = $sortOrder;

        return $this;
    }
}
