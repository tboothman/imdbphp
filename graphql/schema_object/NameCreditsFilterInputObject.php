<?php

namespace GraphQL\SchemaObject;

class NameCreditsFilterInputObject extends InputObject
{
    protected $archived;
    protected $categories;
    protected $credited;
    protected $excludeCategories;
    protected $excludeGenres;
    protected $excludeProductionStage;
    protected $excludeTitleType;
    protected $genres;
    protected $productionStage;
    protected $releaseStatus;
    protected $titleType;
    protected $titleTypeCategory;
    protected $titles;

    public function setArchived($archived)
    {
        $this->archived = $archived;

        return $this;
    }

    public function setCategories(array $categories)
    {
        $this->categories = $categories;

        return $this;
    }

    public function setCredited($credited)
    {
        $this->credited = $credited;

        return $this;
    }

    public function setExcludeCategories(array $excludeCategories)
    {
        $this->excludeCategories = $excludeCategories;

        return $this;
    }

    public function setExcludeGenres(array $excludeGenres)
    {
        $this->excludeGenres = $excludeGenres;

        return $this;
    }

    public function setExcludeProductionStage(array $excludeProductionStage)
    {
        $this->excludeProductionStage = $excludeProductionStage;

        return $this;
    }

    public function setExcludeTitleType(array $excludeTitleType)
    {
        $this->excludeTitleType = $excludeTitleType;

        return $this;
    }

    public function setGenres(array $genres)
    {
        $this->genres = $genres;

        return $this;
    }

    public function setProductionStage(array $productionStage)
    {
        $this->productionStage = $productionStage;

        return $this;
    }

    public function setReleaseStatus(array $releaseStatus)
    {
        $this->releaseStatus = $releaseStatus;

        return $this;
    }

    public function setTitleType(array $titleType)
    {
        $this->titleType = $titleType;

        return $this;
    }

    public function setTitleTypeCategory(array $titleTypeCategory)
    {
        $this->titleTypeCategory = $titleTypeCategory;

        return $this;
    }

    public function setTitles(array $titles)
    {
        $this->titles = $titles;

        return $this;
    }
}
