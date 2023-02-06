<?php

namespace GraphQL\SchemaObject;

class NewsPageInfoQueryObject extends QueryObject
{
    const OBJECT_NAME = "NewsPageInfo";

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
}
