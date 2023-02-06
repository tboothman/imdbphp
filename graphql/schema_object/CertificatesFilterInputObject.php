<?php

namespace GraphQL\SchemaObject;

class CertificatesFilterInputObject extends InputObject
{
    protected $ratingsBody;

    public function setRatingsBody($ratingsBody)
    {
        $this->ratingsBody = $ratingsBody;

        return $this;
    }
}
