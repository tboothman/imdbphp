<?php

namespace GraphQL\SchemaObject;

class UserProfileQueryObject extends QueryObject
{
    const OBJECT_NAME = "UserProfile";

    public function selectNickName()
    {
        $this->selectField("nickName");

        return $this;
    }

    public function selectUserId()
    {
        $this->selectField("userId");

        return $this;
    }
}
