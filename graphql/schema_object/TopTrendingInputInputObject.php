<?php

namespace GraphQL\SchemaObject;

class TopTrendingInputInputObject extends InputObject
{
    protected $dataWindow;
    protected $trafficSource;

    public function setDataWindow($dataWindow)
    {
        $this->dataWindow = $dataWindow;

        return $this;
    }

    public function setTrafficSource($trafficSource)
    {
        $this->trafficSource = $trafficSource;

        return $this;
    }
}
