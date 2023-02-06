<?php

namespace GraphQL\SchemaObject;

class TitleQueryObject extends QueryObject
{
    const OBJECT_NAME = "Title";

    public function selectAggregateRatingsBreakdown(TitleAggregateRatingsBreakdownArgumentsObject $argsObject = null)
    {
        $object = new AggregateRatingsBreakdownQueryObject("aggregateRatingsBreakdown");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectAkas(TitleAkasArgumentsObject $argsObject = null)
    {
        $object = new AkaConnectionQueryObject("akas");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectAlternateVersions(TitleAlternateVersionsArgumentsObject $argsObject = null)
    {
        $object = new AlternateVersionConnectionQueryObject("alternateVersions");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectAwardNominations(TitleAwardNominationsArgumentsObject $argsObject = null)
    {
        $object = new AwardNominationConnectionQueryObject("awardNominations");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    /**
     * @deprecated Use `canHaveEpisodes` on `TitleType` instead.
     */
    public function selectCanHaveEpisodes()
    {
        $this->selectField("canHaveEpisodes");

        return $this;
    }

    public function selectCanRate(TitleCanRateArgumentsObject $argsObject = null)
    {
        $object = new CanRateQueryObject("canRate");
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

    public function selectCertificate(TitleCertificateArgumentsObject $argsObject = null)
    {
        $object = new CertificateQueryObject("certificate");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectCertificates(TitleCertificatesArgumentsObject $argsObject = null)
    {
        $object = new CertificatesConnectionQueryObject("certificates");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectCinemas(TitleCinemasArgumentsObject $argsObject = null)
    {
        $object = new CinemasConnectionQueryObject("cinemas");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectCompanyCreditCategories(TitleCompanyCreditCategoriesArgumentsObject $argsObject = null)
    {
        $object = new CompanyCreditCategoryWithCompanyCreditsQueryObject("companyCreditCategories");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectCompanyCredits(TitleCompanyCreditsArgumentsObject $argsObject = null)
    {
        $object = new CompanyCreditConnectionQueryObject("companyCredits");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectConnectionCategories(TitleConnectionCategoriesArgumentsObject $argsObject = null)
    {
        $object = new ConnectionCategoryWithConnectionsQueryObject("connectionCategories");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectConnections(TitleConnectionsArgumentsObject $argsObject = null)
    {
        $object = new TitleConnectionConnectionQueryObject("connections");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectContributionQuestions(TitleContributionQuestionsArgumentsObject $argsObject = null)
    {
        $object = new QuestionConnectionQueryObject("contributionQuestions");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectCountriesOfOrigin(TitleCountriesOfOriginArgumentsObject $argsObject = null)
    {
        $object = new CountriesOfOriginQueryObject("countriesOfOrigin");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectCrazyCredits(TitleCrazyCreditsArgumentsObject $argsObject = null)
    {
        $object = new CrazyCreditConnectionQueryObject("crazyCredits");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectCreditCategories(TitleCreditCategoriesArgumentsObject $argsObject = null)
    {
        $object = new TitleCreditCategoryWithCreditsQueryObject("creditCategories");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectCredits(TitleCreditsArgumentsObject $argsObject = null)
    {
        $object = new CreditConnectionQueryObject("credits");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectEngagementStatistics(TitleEngagementStatisticsArgumentsObject $argsObject = null)
    {
        $object = new EngagementStatisticsQueryObject("engagementStatistics");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectEpisodes(TitleEpisodesArgumentsObject $argsObject = null)
    {
        $object = new EpisodesQueryObject("episodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectExternalLinkCategories(TitleExternalLinkCategoriesArgumentsObject $argsObject = null)
    {
        $object = new ExternalLinkCategoryWithExternalLinksQueryObject("externalLinkCategories");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectExternalLinks(TitleExternalLinksArgumentsObject $argsObject = null)
    {
        $object = new ExternalLinkConnectionQueryObject("externalLinks");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectFaqs(TitleFaqsArgumentsObject $argsObject = null)
    {
        $object = new FaqConnectionQueryObject("faqs");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectFeaturedPolls(TitleFeaturedPollsArgumentsObject $argsObject = null)
    {
        $object = new PollsConnectionQueryObject("featuredPolls");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectFeaturedReviews(TitleFeaturedReviewsArgumentsObject $argsObject = null)
    {
        $object = new ReviewsConnectionQueryObject("featuredReviews");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectFilmingDates(TitleFilmingDatesArgumentsObject $argsObject = null)
    {
        $object = new FilmingDatesConnectionQueryObject("filmingDates");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectFilmingLocations(TitleFilmingLocationsArgumentsObject $argsObject = null)
    {
        $object = new FilmingLocationConnectionQueryObject("filmingLocations");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    /**
     * @deprecated Use titleGenres instead.
     */
    public function selectGenres(TitleGenresArgumentsObject $argsObject = null)
    {
        $object = new GenresQueryObject("genres");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectGoofCategories(TitleGoofCategoriesArgumentsObject $argsObject = null)
    {
        $object = new GoofCategoryWithGoofsQueryObject("goofCategories");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectGoofs(TitleGoofsArgumentsObject $argsObject = null)
    {
        $object = new GoofConnectionQueryObject("goofs");
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

    public function selectImageUploadLink(TitleImageUploadLinkArgumentsObject $argsObject = null)
    {
        $object = new ContributionLinkQueryObject("imageUploadLink");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectImages(TitleImagesArgumentsObject $argsObject = null)
    {
        $object = new ImageConnectionQueryObject("images");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectIsAdult()
    {
        $this->selectField("isAdult");

        return $this;
    }

    public function selectKeywordItemCategories(TitleKeywordItemCategoriesArgumentsObject $argsObject = null)
    {
        $object = new TitleKeywordItemCategoryWithKeywordsQueryObject("keywordItemCategories");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectKeywords(TitleKeywordsArgumentsObject $argsObject = null)
    {
        $object = new TitleKeywordConnectionQueryObject("keywords");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectLatestTrailer(TitleLatestTrailerArgumentsObject $argsObject = null)
    {
        $object = new VideoQueryObject("latestTrailer");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectLifetimeGross(TitleLifetimeGrossArgumentsObject $argsObject = null)
    {
        $object = new BoxOfficeGrossQueryObject("lifetimeGross");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectMeta(TitleMetaArgumentsObject $argsObject = null)
    {
        $object = new TitleMetaQueryObject("meta");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectMetacritic(TitleMetacriticArgumentsObject $argsObject = null)
    {
        $object = new MetacriticQueryObject("metacritic");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectMeterRanking(TitleMeterRankingArgumentsObject $argsObject = null)
    {
        $object = new TitleMeterRankingQueryObject("meterRanking");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectMoreLikeThisTitles(TitleMoreLikeThisTitlesArgumentsObject $argsObject = null)
    {
        $object = new MoreLikeThisConnectionQueryObject("moreLikeThisTitles");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNews(TitleNewsArgumentsObject $argsObject = null)
    {
        $object = new NewsConnectionQueryObject("news");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNotificationPreferences(TitleNotificationPreferencesArgumentsObject $argsObject = null)
    {
        $object = new NotificationPreferenceQueryObject("notificationPreferences");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectOpeningWeekendGross(TitleOpeningWeekendGrossArgumentsObject $argsObject = null)
    {
        $object = new OpeningWeekendGrossQueryObject("openingWeekendGross");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectOriginalTitleText(TitleOriginalTitleTextArgumentsObject $argsObject = null)
    {
        $object = new TitleTextQueryObject("originalTitleText");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectParentsGuide(TitleParentsGuideArgumentsObject $argsObject = null)
    {
        $object = new ParentsGuideQueryObject("parentsGuide");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectParentsGuideContributionLink(TitleParentsGuideContributionLinkArgumentsObject $argsObject = null)
    {
        $object = new ContributionLinkQueryObject("parentsGuideContributionLink");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPlot(TitlePlotArgumentsObject $argsObject = null)
    {
        $object = new PlotQueryObject("plot");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPlotContributionLink(TitlePlotContributionLinkArgumentsObject $argsObject = null)
    {
        $object = new ContributionLinkQueryObject("plotContributionLink");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPlots(TitlePlotsArgumentsObject $argsObject = null)
    {
        $object = new PlotConnectionQueryObject("plots");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPrestigiousAwardSummary(TitlePrestigiousAwardSummaryArgumentsObject $argsObject = null)
    {
        $object = new PrestigiousAwardSummaryQueryObject("prestigiousAwardSummary");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPrimaryImage(TitlePrimaryImageArgumentsObject $argsObject = null)
    {
        $object = new ImageQueryObject("primaryImage");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPrimaryVideos(TitlePrimaryVideosArgumentsObject $argsObject = null)
    {
        $object = new VideoConnectionQueryObject("primaryVideos");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPrimaryWatchOption(TitlePrimaryWatchOptionArgumentsObject $argsObject = null)
    {
        $object = new PrimaryWatchOptionQueryObject("primaryWatchOption");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPrincipalCredits(TitlePrincipalCreditsArgumentsObject $argsObject = null)
    {
        $object = new PrincipalCreditsForCategoryQueryObject("principalCredits");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectProductionBudget(TitleProductionBudgetArgumentsObject $argsObject = null)
    {
        $object = new ProductionBudgetQueryObject("productionBudget");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectProductionStatus(TitleProductionStatusArgumentsObject $argsObject = null)
    {
        $object = new ProductionStatusDetailsQueryObject("productionStatus");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectQuotes(TitleQuotesArgumentsObject $argsObject = null)
    {
        $object = new TitleQuoteConnectionQueryObject("quotes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectRankedLifetimeGross(TitleRankedLifetimeGrossArgumentsObject $argsObject = null)
    {
        $object = new RankedLifetimeBoxOfficeGrossQueryObject("rankedLifetimeGross");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectRankedLifetimeGrosses(TitleRankedLifetimeGrossesArgumentsObject $argsObject = null)
    {
        $object = new RankedLifetimeBoxOfficeGrossConnectionQueryObject("rankedLifetimeGrosses");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectRatingsSummary(TitleRatingsSummaryArgumentsObject $argsObject = null)
    {
        $object = new RatingsSummaryQueryObject("ratingsSummary");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectReleaseDate(TitleReleaseDateArgumentsObject $argsObject = null)
    {
        $object = new ReleaseDateQueryObject("releaseDate");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectReleaseDates(TitleReleaseDatesArgumentsObject $argsObject = null)
    {
        $object = new ReleaseDateConnectionQueryObject("releaseDates");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectReleaseYear(TitleReleaseYearArgumentsObject $argsObject = null)
    {
        $object = new YearRangeQueryObject("releaseYear");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectReviewContributionLink(TitleReviewContributionLinkArgumentsObject $argsObject = null)
    {
        $object = new ContributionLinkQueryObject("reviewContributionLink");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectReviews(TitleReviewsArgumentsObject $argsObject = null)
    {
        $object = new ReviewsConnectionQueryObject("reviews");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectRuntime(TitleRuntimeArgumentsObject $argsObject = null)
    {
        $object = new RuntimeQueryObject("runtime");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectRuntimes(TitleRuntimesArgumentsObject $argsObject = null)
    {
        $object = new RuntimeConnectionQueryObject("runtimes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectSeries(TitleSeriesArgumentsObject $argsObject = null)
    {
        $object = new SeriesQueryObject("series");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectSoundtrack(TitleSoundtrackArgumentsObject $argsObject = null)
    {
        $object = new SoundtrackConnectionQueryObject("soundtrack");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectSpokenLanguages(TitleSpokenLanguagesArgumentsObject $argsObject = null)
    {
        $object = new SpokenLanguagesQueryObject("spokenLanguages");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTaglines(TitleTaglinesArgumentsObject $argsObject = null)
    {
        $object = new TaglineConnectionQueryObject("taglines");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTechnicalSpecifications(TitleTechnicalSpecificationsArgumentsObject $argsObject = null)
    {
        $object = new TechnicalSpecificationsQueryObject("technicalSpecifications");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTitleGenres(TitleTitleGenresArgumentsObject $argsObject = null)
    {
        $object = new TitleGenresQueryObject("titleGenres");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTitleText(TitleTitleTextArgumentsObject $argsObject = null)
    {
        $object = new TitleTextQueryObject("titleText");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTitleType(TitleTitleTypeArgumentsObject $argsObject = null)
    {
        $object = new TitleTypeQueryObject("titleType");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTrivia(TitleTriviaArgumentsObject $argsObject = null)
    {
        $object = new TriviaConnectionQueryObject("trivia");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTriviaCategories(TitleTriviaCategoriesArgumentsObject $argsObject = null)
    {
        $object = new TriviaCategoryWithTriviaQueryObject("triviaCategories");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTriviaContributionLink(TitleTriviaContributionLinkArgumentsObject $argsObject = null)
    {
        $object = new ContributionLinkQueryObject("triviaContributionLink");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectUserRating(TitleUserRatingArgumentsObject $argsObject = null)
    {
        $object = new RatingQueryObject("userRating");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectVideoStrip(TitleVideoStripArgumentsObject $argsObject = null)
    {
        $object = new VideoConnectionQueryObject("videoStrip");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    /**
     * @deprecated Use `title.videoStrip.total` for the total video count.
     */
    public function selectVideos(TitleVideosArgumentsObject $argsObject = null)
    {
        $object = new TitleRelatedVideosConnectionQueryObject("videos");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectWatchOption(TitleWatchOptionArgumentsObject $argsObject = null)
    {
        $object = new WatchOptionQueryObject("watchOption");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectWatchOptionsByCategory(TitleWatchOptionsByCategoryArgumentsObject $argsObject = null)
    {
        $object = new CategorizedWatchOptionsListQueryObject("watchOptionsByCategory");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
