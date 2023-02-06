<?php

namespace GraphQL\SchemaObject;

class TitleFeaturedReviewsArgumentsObject extends ArgumentsObject
{
    protected $first;

    public function setFirst($first)
    {
        $this->first = $first;

        return $this;
    }
}
