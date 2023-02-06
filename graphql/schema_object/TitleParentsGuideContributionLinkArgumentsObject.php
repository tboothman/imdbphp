<?php

namespace GraphQL\SchemaObject;

class TitleParentsGuideContributionLinkArgumentsObject extends ArgumentsObject
{
    protected $contributionContext;

    public function setContributionContext(ContributionContextInputObject $contributionContextInputObject)
    {
        $this->contributionContext = $contributionContextInputObject;

        return $this;
    }
}
