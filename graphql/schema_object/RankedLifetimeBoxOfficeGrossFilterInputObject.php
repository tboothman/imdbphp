<?php

namespace GraphQL\SchemaObject;

class RankedLifetimeBoxOfficeGrossFilterInputObject extends InputObject
{
    protected $boxOfficeAreaCodes;

    public function setBoxOfficeAreaCodes(array $boxOfficeAreaCodes)
    {
        $this->boxOfficeAreaCodes = $boxOfficeAreaCodes;

        return $this;
    }
}
