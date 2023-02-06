<?php

namespace GraphQL\SchemaObject;

class MainSearchOptionsInputObject extends InputObject
{
    protected $includeAdult;
    protected $isExactMatch;
    protected $searchTerm;
    protected $titleSearchOptions;
    protected $type;

    public function setIncludeAdult($includeAdult)
    {
        $this->includeAdult = $includeAdult;

        return $this;
    }

    public function setIsExactMatch($isExactMatch)
    {
        $this->isExactMatch = $isExactMatch;

        return $this;
    }

    public function setSearchTerm($searchTerm)
    {
        $this->searchTerm = $searchTerm;

        return $this;
    }

    public function setTitleSearchOptions(TitleSearchOptionsInputObject $titleSearchOptionsInputObject)
    {
        $this->titleSearchOptions = $titleSearchOptionsInputObject;

        return $this;
    }

    public function setType(array $type)
    {
        $this->type = $type;

        return $this;
    }
}
