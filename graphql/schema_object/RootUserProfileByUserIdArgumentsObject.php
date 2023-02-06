<?php

namespace GraphQL\SchemaObject;

class RootUserProfileByUserIdArgumentsObject extends ArgumentsObject
{
    protected $userId;

    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }
}
