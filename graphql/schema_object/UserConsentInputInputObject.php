<?php

namespace GraphQL\SchemaObject;

class UserConsentInputInputObject extends InputObject
{
    protected $consentType;
    protected $idfa;

    public function setConsentType($consentType)
    {
        $this->consentType = $consentType;

        return $this;
    }

    public function setIdfa($idfa)
    {
        $this->idfa = $idfa;

        return $this;
    }
}
