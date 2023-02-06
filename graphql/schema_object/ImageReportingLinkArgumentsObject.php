<?php

namespace GraphQL\SchemaObject;

class ImageReportingLinkArgumentsObject extends ArgumentsObject
{
    protected $contributionContext;
    protected $relatedId;

    public function setContributionContext(ContributionContextInputObject $contributionContextInputObject)
    {
        $this->contributionContext = $contributionContextInputObject;

        return $this;
    }

    public function setRelatedId($relatedId)
    {
        $this->relatedId = $relatedId;

        return $this;
    }
}
