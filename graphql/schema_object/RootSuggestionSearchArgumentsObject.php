<?php

namespace GraphQL\SchemaObject;

class RootSuggestionSearchArgumentsObject extends ArgumentsObject
{
    protected $filter;
    protected $first;
    protected $searchTerm;
    protected $shouldShowOriginalTitles;

    public function setFilter(SuggestionSearchFilterInputObject $suggestionSearchFilterInputObject)
    {
        $this->filter = $suggestionSearchFilterInputObject;

        return $this;
    }

    public function setFirst($first)
    {
        $this->first = $first;

        return $this;
    }

    public function setSearchTerm($searchTerm)
    {
        $this->searchTerm = $searchTerm;

        return $this;
    }

    public function setShouldShowOriginalTitles($shouldShowOriginalTitles)
    {
        $this->shouldShowOriginalTitles = $shouldShowOriginalTitles;

        return $this;
    }
}
