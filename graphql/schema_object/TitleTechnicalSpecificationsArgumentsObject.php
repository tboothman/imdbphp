<?php

namespace GraphQL\SchemaObject;

class TitleTechnicalSpecificationsArgumentsObject extends ArgumentsObject
{
    protected $filter;

    public function setFilter(TechnicalSpecificationsFilterInputObject $technicalSpecificationsFilterInputObject)
    {
        $this->filter = $technicalSpecificationsFilterInputObject;

        return $this;
    }
}
