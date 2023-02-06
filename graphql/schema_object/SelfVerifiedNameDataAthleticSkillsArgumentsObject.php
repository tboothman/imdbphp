<?php

namespace GraphQL\SchemaObject;

class SelfVerifiedNameDataAthleticSkillsArgumentsObject extends ArgumentsObject
{
    protected $limit;

    public function setLimit($limit)
    {
        $this->limit = $limit;

        return $this;
    }
}
