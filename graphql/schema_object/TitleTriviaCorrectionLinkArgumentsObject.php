<?php

namespace GraphQL\SchemaObject;

class TitleTriviaCorrectionLinkArgumentsObject extends ArgumentsObject
{
    protected $contributionContext;

    public function setContributionContext(ContributionContextInputObject $contributionContextInputObject)
    {
        $this->contributionContext = $contributionContextInputObject;

        return $this;
    }
}
