<?php

namespace GraphQL\SchemaObject;

use GraphQL\RawObject;

class TitleOpeningWeekendGrossArgumentsObject extends ArgumentsObject
{
    protected $boxOfficeArea;

    public function setBoxOfficeArea($boxOfficeArea)
    {
        $this->boxOfficeArea = new RawObject($boxOfficeArea);

        return $this;
    }
}
