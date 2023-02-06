<?php

namespace GraphQL\SchemaObject;

class LanguageSearchConstraintInputObject extends InputObject
{
    protected $anyLanguages;
    protected $anyPrimaryLanguages;
    protected $isSilent;

    public function setAnyLanguages(array $anyLanguages)
    {
        $this->anyLanguages = $anyLanguages;

        return $this;
    }

    public function setAnyPrimaryLanguages(array $anyPrimaryLanguages)
    {
        $this->anyPrimaryLanguages = $anyPrimaryLanguages;

        return $this;
    }

    public function setIsSilent($isSilent)
    {
        $this->isSilent = $isSilent;

        return $this;
    }
}
