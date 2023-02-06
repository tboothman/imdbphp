<?php

namespace GraphQL\SchemaObject;

class AdvancedTitleSearchConstraintsInputObject extends InputObject
{
    protected $awardConstraint;
    protected $certificateConstraint;
    protected $creditedNameConstraint;
    protected $explicitContentConstraint;
    protected $genreConstraint;
    protected $keywordConstraint;
    protected $languageConstraint;
    protected $myRatingConstraint;
    protected $originCountryConstraint;
    protected $releaseDateConstraint;
    protected $runtimeConstraint;
    protected $titleMeterConstraint;
    protected $titleTextConstraint;
    protected $titleTypeConstraint;
    protected $userRatingsConstraint;
    protected $watchOptionsConstraint;

    public function setAwardConstraint(AwardSearchConstraintInputObject $awardSearchConstraintInputObject)
    {
        $this->awardConstraint = $awardSearchConstraintInputObject;

        return $this;
    }

    public function setCertificateConstraint(CertificateSearchConstraintInputObject $certificateSearchConstraintInputObject)
    {
        $this->certificateConstraint = $certificateSearchConstraintInputObject;

        return $this;
    }

    public function setCreditedNameConstraint(CreditedNameConstraintInputObject $creditedNameConstraintInputObject)
    {
        $this->creditedNameConstraint = $creditedNameConstraintInputObject;

        return $this;
    }

    public function setExplicitContentConstraint(ExplicitContentSearchConstraintInputObject $explicitContentSearchConstraintInputObject)
    {
        $this->explicitContentConstraint = $explicitContentSearchConstraintInputObject;

        return $this;
    }

    public function setGenreConstraint(GenreSearchConstraintInputObject $genreSearchConstraintInputObject)
    {
        $this->genreConstraint = $genreSearchConstraintInputObject;

        return $this;
    }

    public function setKeywordConstraint(KeywordSearchConstraintInputObject $keywordSearchConstraintInputObject)
    {
        $this->keywordConstraint = $keywordSearchConstraintInputObject;

        return $this;
    }

    public function setLanguageConstraint(LanguageSearchConstraintInputObject $languageSearchConstraintInputObject)
    {
        $this->languageConstraint = $languageSearchConstraintInputObject;

        return $this;
    }

    public function setMyRatingConstraint(MyRatingSearchConstraintInputObject $myRatingSearchConstraintInputObject)
    {
        $this->myRatingConstraint = $myRatingSearchConstraintInputObject;

        return $this;
    }

    public function setOriginCountryConstraint(OriginCountrySearchConstraintInputObject $originCountrySearchConstraintInputObject)
    {
        $this->originCountryConstraint = $originCountrySearchConstraintInputObject;

        return $this;
    }

    public function setReleaseDateConstraint(ReleaseDateSearchConstraintInputObject $releaseDateSearchConstraintInputObject)
    {
        $this->releaseDateConstraint = $releaseDateSearchConstraintInputObject;

        return $this;
    }

    public function setRuntimeConstraint(RuntimeSearchConstraintInputObject $runtimeSearchConstraintInputObject)
    {
        $this->runtimeConstraint = $runtimeSearchConstraintInputObject;

        return $this;
    }

    public function setTitleMeterConstraint(TitleMeterSearchConstraintInputObject $titleMeterSearchConstraintInputObject)
    {
        $this->titleMeterConstraint = $titleMeterSearchConstraintInputObject;

        return $this;
    }

    public function setTitleTextConstraint(TitleTextSearchConstraintInputObject $titleTextSearchConstraintInputObject)
    {
        $this->titleTextConstraint = $titleTextSearchConstraintInputObject;

        return $this;
    }

    public function setTitleTypeConstraint(TitleTypeSearchConstraintInputObject $titleTypeSearchConstraintInputObject)
    {
        $this->titleTypeConstraint = $titleTypeSearchConstraintInputObject;

        return $this;
    }

    public function setUserRatingsConstraint(UserRatingsSearchConstraintInputObject $userRatingsSearchConstraintInputObject)
    {
        $this->userRatingsConstraint = $userRatingsSearchConstraintInputObject;

        return $this;
    }

    public function setWatchOptionsConstraint(WatchOptionsSearchConstraintInputObject $watchOptionsSearchConstraintInputObject)
    {
        $this->watchOptionsConstraint = $watchOptionsSearchConstraintInputObject;

        return $this;
    }
}
