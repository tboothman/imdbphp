<?php

namespace GraphQL\SchemaObject;

class TitleMeterRankingInputInputObject extends InputObject
{
    protected $meterType;

    public function setMeterType($meterType)
    {
        $this->meterType = $meterType;

        return $this;
    }
}
