<?php

namespace GraphQL\SchemaObject;

class CertificateSearchConstraintInputObject extends InputObject
{
    protected $anyRegionCertificateRatings;
    protected $excludeRegionCertificateRatings;

    public function setAnyRegionCertificateRatings(array $anyRegionCertificateRatings)
    {
        $this->anyRegionCertificateRatings = $anyRegionCertificateRatings;

        return $this;
    }

    public function setExcludeRegionCertificateRatings(array $excludeRegionCertificateRatings)
    {
        $this->excludeRegionCertificateRatings = $excludeRegionCertificateRatings;

        return $this;
    }
}
