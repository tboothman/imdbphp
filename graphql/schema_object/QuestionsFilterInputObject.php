<?php

namespace GraphQL\SchemaObject;

class QuestionsFilterInputObject extends InputObject
{
    protected $country;
    protected $dataType;
    protected $dataTypes;
    protected $language;

    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    public function setDataType($dataType)
    {
        $this->dataType = $dataType;

        return $this;
    }

    public function setDataTypes(array $dataTypes)
    {
        $this->dataTypes = $dataTypes;

        return $this;
    }

    public function setLanguage($language)
    {
        $this->language = $language;

        return $this;
    }
}
