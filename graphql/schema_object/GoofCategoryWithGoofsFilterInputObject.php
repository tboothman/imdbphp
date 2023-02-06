<?php

namespace GraphQL\SchemaObject;

class GoofCategoryWithGoofsFilterInputObject extends InputObject
{
    protected $spoilers;

    public function setSpoilers($spoilers)
    {
        $this->spoilers = $spoilers;

        return $this;
    }
}
