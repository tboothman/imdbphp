<?php

namespace GraphQL\SchemaObject;

class ReviewsFilterInputObject extends InputObject
{
    protected $authorRating;
    protected $spoiler;

    public function setAuthorRating($authorRating)
    {
        $this->authorRating = $authorRating;

        return $this;
    }

    public function setSpoiler($spoiler)
    {
        $this->spoiler = $spoiler;

        return $this;
    }
}
