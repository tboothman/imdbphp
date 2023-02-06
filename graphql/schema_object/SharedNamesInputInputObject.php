<?php

namespace GraphQL\SchemaObject;

class SharedNamesInputInputObject extends InputObject
{
    protected $input;
    protected $nameId;

    public function setInput($input)
    {
        $this->input = $input;

        return $this;
    }

    public function setNameId($nameId)
    {
        $this->nameId = $nameId;

        return $this;
    }
}
