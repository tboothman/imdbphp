<?php

namespace GraphQL\SchemaObject;

class CompanyKeyStaffSummaryEmploymentArgumentsObject extends ArgumentsObject
{
    protected $limit;

    public function setLimit($limit)
    {
        $this->limit = $limit;

        return $this;
    }
}
