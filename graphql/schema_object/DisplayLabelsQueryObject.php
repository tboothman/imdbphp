<?php

namespace GraphQL\SchemaObject;

class DisplayLabelsQueryObject extends QueryObject
{
    const OBJECT_NAME = "DisplayLabels";

    public function selectPrimaryLabel()
    {
        $this->selectField("primaryLabel");

        return $this;
    }

    public function selectSecondaryLabel()
    {
        $this->selectField("secondaryLabel");

        return $this;
    }
}
