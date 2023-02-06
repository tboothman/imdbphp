<?php

namespace GraphQL\SchemaObject;

class TitleRelatedVideosConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "TitleRelatedVideosConnection";

    public function selectTotal()
    {
        $this->selectField("total");

        return $this;
    }
}
