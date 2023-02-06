<?php

namespace GraphQL\SchemaObject;

class TestAuthQueryObject extends QueryObject
{
    const OBJECT_NAME = "TestAuth";

    public function selectCacheableResult()
    {
        $this->selectField("cacheableResult");

        return $this;
    }

    public function selectCacheableResultWithNoCacheCustomerId()
    {
        $this->selectField("cacheableResultWithNoCacheCustomerId");

        return $this;
    }

    public function selectCacheableResultWithNoCacheUserId()
    {
        $this->selectField("cacheableResultWithNoCacheUserId");

        return $this;
    }

    public function selectClientIp()
    {
        $this->selectField("clientIp");

        return $this;
    }

    public function selectDetectedCountry()
    {
        $this->selectField("detectedCountry");

        return $this;
    }

    public function selectHasAuthenticationHeaders()
    {
        $this->selectField("hasAuthenticationHeaders");

        return $this;
    }

    public function selectNonCacheableResult()
    {
        $this->selectField("nonCacheableResult");

        return $this;
    }

    public function selectResult()
    {
        $this->selectField("result");

        return $this;
    }
}
