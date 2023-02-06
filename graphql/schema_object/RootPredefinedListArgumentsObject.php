<?php

namespace GraphQL\SchemaObject;

use GraphQL\RawObject;

class RootPredefinedListArgumentsObject extends ArgumentsObject
{
    protected $classType;
    protected $userId;

    public function setClassType($listClassId)
    {
        $this->classType = new RawObject($listClassId);

        return $this;
    }

    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }
}
