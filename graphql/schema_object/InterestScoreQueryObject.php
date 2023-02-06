<?php

namespace GraphQL\SchemaObject;

class InterestScoreQueryObject extends QueryObject
{
    const OBJECT_NAME = "InterestScore";

    public function selectUsersInterested()
    {
        $this->selectField("usersInterested");

        return $this;
    }

    public function selectUsersVoted()
    {
        $this->selectField("usersVoted");

        return $this;
    }
}
