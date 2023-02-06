<?php

namespace GraphQL\SchemaObject;

class PageInfoQueryObject extends QueryObject
{
    const OBJECT_NAME = "PageInfo";

    public function selectEndCursor()
    {
        $this->selectField("endCursor");

        return $this;
    }

    public function selectHasNextPage()
    {
        $this->selectField("hasNextPage");

        return $this;
    }

    public function selectHasPreviousPage()
    {
        $this->selectField("hasPreviousPage");

        return $this;
    }

    public function selectStartCursor()
    {
        $this->selectField("startCursor");

        return $this;
    }
}
