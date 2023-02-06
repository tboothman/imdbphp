<?php

namespace GraphQL\SchemaObject;

class ContributionContextInputObject extends InputObject
{
    protected $business;
    protected $isInIframe;
    protected $returnUrl;

    public function setBusiness($business)
    {
        $this->business = $business;

        return $this;
    }

    public function setIsInIframe($isInIframe)
    {
        $this->isInIframe = $isInIframe;

        return $this;
    }

    public function setReturnUrl($returnUrl)
    {
        $this->returnUrl = $returnUrl;

        return $this;
    }
}
