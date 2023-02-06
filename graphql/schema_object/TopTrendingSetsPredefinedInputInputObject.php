<?php

namespace GraphQL\SchemaObject;

class TopTrendingSetsPredefinedInputInputObject extends InputObject
{
    protected $topTrendingSetPredefined;

    public function setTopTrendingSetPredefined($topTrendingSetPredefined)
    {
        $this->topTrendingSetPredefined = $topTrendingSetPredefined;

        return $this;
    }
}
