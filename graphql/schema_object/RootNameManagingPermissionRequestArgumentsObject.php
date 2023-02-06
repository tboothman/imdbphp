<?php

namespace GraphQL\SchemaObject;

class RootNameManagingPermissionRequestArgumentsObject extends ArgumentsObject
{
    protected $id;
    protected $token;

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }
}
