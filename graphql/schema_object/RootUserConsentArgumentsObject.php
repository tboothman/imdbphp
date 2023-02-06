<?php

namespace GraphQL\SchemaObject;

class RootUserConsentArgumentsObject extends ArgumentsObject
{
    protected $input;

    public function setInput(UserConsentInputInputObject $userConsentInputInputObject)
    {
        $this->input = $userConsentInputInputObject;

        return $this;
    }
}
