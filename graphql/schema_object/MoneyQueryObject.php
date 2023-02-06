<?php

namespace GraphQL\SchemaObject;

class MoneyQueryObject extends QueryObject
{
    const OBJECT_NAME = "Money";

    public function selectAmount()
    {
        $this->selectField("amount");

        return $this;
    }

    public function selectCurrency()
    {
        $this->selectField("currency");

        return $this;
    }
}
