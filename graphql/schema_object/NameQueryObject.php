<?php

namespace GraphQL\SchemaObject;

class NameQueryObject extends QueryObject
{
    const OBJECT_NAME = "Name";

    public function selectAge(NameAgeArgumentsObject $argsObject = null)
    {
        $object = new AgeDetailsQueryObject("age");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectAkas(NameAkasArgumentsObject $argsObject = null)
    {
        $object = new NameAkaConnectionQueryObject("akas");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectAwardNominations(NameAwardNominationsArgumentsObject $argsObject = null)
    {
        $object = new AwardNominationConnectionQueryObject("awardNominations");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectBio(NameBioArgumentsObject $argsObject = null)
    {
        $object = new NameBioQueryObject("bio");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    /**
     * @deprecated Use birthDate and birthLocation instead.
     */
    public function selectBirth(NameBirthArgumentsObject $argsObject = null)
    {
        $object = new NameBirthQueryObject("birth");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectBirthDate(NameBirthDateArgumentsObject $argsObject = null)
    {
        $object = new DisplayableDateQueryObject("birthDate");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectBirthLocation(NameBirthLocationArgumentsObject $argsObject = null)
    {
        $object = new DisplayableLocationQueryObject("birthLocation");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectBirthName(NameBirthNameArgumentsObject $argsObject = null)
    {
        $object = new BirthNameQueryObject("birthName");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectCanonicalUrl()
    {
        $this->selectField("canonicalUrl");

        return $this;
    }

    public function selectContentWarnings(NameContentWarningsArgumentsObject $argsObject = null)
    {
        $object = new ContentWarningsQueryObject("contentWarnings");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectCreditCategories(NameCreditCategoriesArgumentsObject $argsObject = null)
    {
        $object = new NameCreditCategoryWithCreditsQueryObject("creditCategories");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectCreditSummary(NameCreditSummaryArgumentsObject $argsObject = null)
    {
        $object = new NameCreditSummaryQueryObject("creditSummary");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectCredits(NameCreditsArgumentsObject $argsObject = null)
    {
        $object = new NameCreditConnectionQueryObject("credits");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    /**
     * @deprecated Use deathDate, deathLocation and deathCause instead.
     */
    public function selectDeath(NameDeathArgumentsObject $argsObject = null)
    {
        $object = new NameDeathQueryObject("death");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectDeathCause(NameDeathCauseArgumentsObject $argsObject = null)
    {
        $object = new DisplayableNameDeathCauseQueryObject("deathCause");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectDeathDate(NameDeathDateArgumentsObject $argsObject = null)
    {
        $object = new DisplayableDateQueryObject("deathDate");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectDeathLocation(NameDeathLocationArgumentsObject $argsObject = null)
    {
        $object = new DisplayableLocationQueryObject("deathLocation");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectDeathStatus()
    {
        $this->selectField("deathStatus");

        return $this;
    }

    public function selectDemographicData(NameDemographicDataArgumentsObject $argsObject = null)
    {
        $object = new DemographicDataItemQueryObject("demographicData");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectDisambiguator(NameDisambiguatorArgumentsObject $argsObject = null)
    {
        $object = new DisambiguationQueryObject("disambiguator");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectExternalLinkCategories(NameExternalLinkCategoriesArgumentsObject $argsObject = null)
    {
        $object = new ExternalLinkCategoryWithExternalLinksQueryObject("externalLinkCategories");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectExternalLinks(NameExternalLinksArgumentsObject $argsObject = null)
    {
        $object = new ExternalLinkConnectionQueryObject("externalLinks");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectFeaturedPolls(NameFeaturedPollsArgumentsObject $argsObject = null)
    {
        $object = new PollsConnectionQueryObject("featuredPolls");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectHeight(NameHeightArgumentsObject $argsObject = null)
    {
        $object = new NameHeightQueryObject("height");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectImageUploadLink(NameImageUploadLinkArgumentsObject $argsObject = null)
    {
        $object = new ContributionLinkQueryObject("imageUploadLink");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectImages(NameImagesArgumentsObject $argsObject = null)
    {
        $object = new ImageConnectionQueryObject("images");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectIsClaimed()
    {
        $this->selectField("isClaimed");

        return $this;
    }

    public function selectKnownFor(NameKnownForArgumentsObject $argsObject = null)
    {
        $object = new NameKnownForConnectionQueryObject("knownFor");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectManagedData(NameManagedDataArgumentsObject $argsObject = null)
    {
        $object = new NameManagedDataQueryObject("managedData");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectMeta(NameMetaArgumentsObject $argsObject = null)
    {
        $object = new NameMetaQueryObject("meta");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectMeterRanking(NameMeterRankingArgumentsObject $argsObject = null)
    {
        $object = new NameMeterRankingQueryObject("meterRanking");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectMeterRankingHistory(NameMeterRankingHistoryArgumentsObject $argsObject = null)
    {
        $object = new NameMeterRankingHistoryQueryObject("meterRankingHistory");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNameText(NameNameTextArgumentsObject $argsObject = null)
    {
        $object = new NameTextQueryObject("nameText");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNews(NameNewsArgumentsObject $argsObject = null)
    {
        $object = new NewsConnectionQueryObject("news");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNickNames(NameNickNamesArgumentsObject $argsObject = null)
    {
        $object = new NickNameQueryObject("nickNames");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNotificationPreferences(NameNotificationPreferencesArgumentsObject $argsObject = null)
    {
        $object = new NotificationPreferenceQueryObject("notificationPreferences");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectOtherWorks(NameOtherWorksArgumentsObject $argsObject = null)
    {
        $object = new NameOtherWorkConnectionQueryObject("otherWorks");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPrestigiousAwardSummary(NamePrestigiousAwardSummaryArgumentsObject $argsObject = null)
    {
        $object = new PrestigiousAwardSummaryQueryObject("prestigiousAwardSummary");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPrimaryImage(NamePrimaryImageArgumentsObject $argsObject = null)
    {
        $object = new ImageQueryObject("primaryImage");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPrimaryProfessions(NamePrimaryProfessionsArgumentsObject $argsObject = null)
    {
        $object = new PrimaryProfessionQueryObject("primaryProfessions");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPrimaryVideos(NamePrimaryVideosArgumentsObject $argsObject = null)
    {
        $object = new VideoConnectionQueryObject("primaryVideos");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    /**
     * @deprecated Use name.credits instead
     */
    public function selectProjectsInDevelopment(NameProjectsInDevelopmentArgumentsObject $argsObject = null)
    {
        $object = new NameCreditConnectionQueryObject("projectsInDevelopment");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPublicityCategories(NamePublicityCategoriesArgumentsObject $argsObject = null)
    {
        $object = new PublicityCategoryWithListingsQueryObject("publicityCategories");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPublicityListings(NamePublicityListingsArgumentsObject $argsObject = null)
    {
        $object = new PublicityListingConnectionQueryObject("publicityListings");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectQuotes(NameQuotesArgumentsObject $argsObject = null)
    {
        $object = new NameQuoteConnectionQueryObject("quotes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectRelations(NameRelationsArgumentsObject $argsObject = null)
    {
        $object = new NameRelationsConnectionQueryObject("relations");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectSearchIndexing(NameSearchIndexingArgumentsObject $argsObject = null)
    {
        $object = new NameSearchIndexingQueryObject("searchIndexing");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectSelfVerifiedData(NameSelfVerifiedDataArgumentsObject $argsObject = null)
    {
        $object = new SelfVerifiedNameDataQueryObject("selfVerifiedData");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectSharedNames(NameSharedNamesArgumentsObject $argsObject = null)
    {
        $object = new SharedNamesResultQueryObject("sharedNames");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectSharedTitles(NameSharedTitlesArgumentsObject $argsObject = null)
    {
        $object = new SharedTitlesConnectionQueryObject("sharedTitles");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectSpouses(NameSpousesArgumentsObject $argsObject = null)
    {
        $object = new NameSpouseQueryObject("spouses");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTitleSalaries(NameTitleSalariesArgumentsObject $argsObject = null)
    {
        $object = new SalaryConnectionQueryObject("titleSalaries");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTrademarks(NameTrademarksArgumentsObject $argsObject = null)
    {
        $object = new TrademarkConnectionQueryObject("trademarks");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTrivia(NameTriviaArgumentsObject $argsObject = null)
    {
        $object = new NameTriviaConnectionQueryObject("trivia");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectVanityUrl(NameVanityUrlArgumentsObject $argsObject = null)
    {
        $object = new VanityUrlQueryObject("vanityUrl");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectVideos(NameVideosArgumentsObject $argsObject = null)
    {
        $object = new VideoConnectionQueryObject("videos");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
