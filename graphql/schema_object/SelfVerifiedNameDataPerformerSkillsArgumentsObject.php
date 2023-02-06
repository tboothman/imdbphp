<?php

namespace GraphQL\SchemaObject;

class SelfVerifiedNameDataPerformerSkillsArgumentsObject extends ArgumentsObject
{
    protected $limit;

    public function setLimit($limit)
    {
        $this->limit = $limit;

        return $this;
    }
}
