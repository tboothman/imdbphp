<?php

namespace GraphQL\SchemaObject;

class ListItemFilterInputObject extends InputObject
{
    protected $rated;
    protected $released;

    public function setRated($rated)
    {
        $this->rated = $rated;

        return $this;
    }

    public function setReleased($released)
    {
        $this->released = $released;

        return $this;
    }
}
