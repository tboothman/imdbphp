<?php

namespace GraphQL\SchemaObject;

class SupportedQuestionFiltersQueryObject extends QueryObject
{
    const OBJECT_NAME = "SupportedQuestionFilters";

    public function selectCountries()
    {
        $this->selectField("countries");

        return $this;
    }

    public function selectDataTypes()
    {
        $this->selectField("dataTypes");

        return $this;
    }

    public function selectLanguages()
    {
        $this->selectField("languages");

        return $this;
    }
}
