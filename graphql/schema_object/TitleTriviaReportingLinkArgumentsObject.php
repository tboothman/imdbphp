<?php

namespace GraphQL\SchemaObject;

class TitleTriviaReportingLinkArgumentsObject extends ArgumentsObject
{
    protected $contributionContext;

    public function setContributionContext(ContributionContextInputObject $contributionContextInputObject)
    {
        $this->contributionContext = $contributionContextInputObject;

        return $this;
    }
}
