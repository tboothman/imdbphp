<?php

namespace GraphQL\SchemaObject;

class SelfVerifiedNameDataDanceSkillsArgumentsObject extends ArgumentsObject
{
    protected $limit;

    public function setLimit($limit)
    {
        $this->limit = $limit;

        return $this;
    }
}
