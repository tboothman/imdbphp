<?php

namespace GraphQL\SchemaObject;

class FilmingDatesQueryObject extends QueryObject
{
    const OBJECT_NAME = "FilmingDates";

    public function selectEndDate()
    {
        $this->selectField("endDate");

        return $this;
    }

    public function selectStartDate()
    {
        $this->selectField("startDate");

        return $this;
    }
}
