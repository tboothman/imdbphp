<?php

namespace GraphQL\SchemaObject;

class CanRateQueryObject extends QueryObject
{
    const OBJECT_NAME = "CanRate";

    public function selectIsRatable()
    {
        $this->selectField("isRatable");

        return $this;
    }
}
