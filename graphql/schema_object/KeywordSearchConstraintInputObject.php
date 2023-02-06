<?php

namespace GraphQL\SchemaObject;

class KeywordSearchConstraintInputObject extends InputObject
{
    protected $allKeywords;
    protected $anyKeywords;

    public function setAllKeywords(array $allKeywords)
    {
        $this->allKeywords = $allKeywords;

        return $this;
    }

    public function setAnyKeywords(array $anyKeywords)
    {
        $this->anyKeywords = $anyKeywords;

        return $this;
    }
}
