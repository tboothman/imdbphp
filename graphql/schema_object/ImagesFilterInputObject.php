<?php

namespace GraphQL\SchemaObject;

class ImagesFilterInputObject extends InputObject
{
    protected $namesCount;
    protected $types;

    public function setNamesCount(CountIntervalInputObject $countIntervalInputObject)
    {
        $this->namesCount = $countIntervalInputObject;

        return $this;
    }

    public function setTypes(array $types)
    {
        $this->types = $types;

        return $this;
    }
}
