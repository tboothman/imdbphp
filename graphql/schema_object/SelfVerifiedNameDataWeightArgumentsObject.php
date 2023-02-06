<?php

namespace GraphQL\SchemaObject;

class SelfVerifiedNameDataWeightArgumentsObject extends ArgumentsObject
{
    protected $input;

    public function setInput(GetNameWeightInputInputObject $getNameWeightInputInputObject)
    {
        $this->input = $getNameWeightInputInputObject;

        return $this;
    }
}
