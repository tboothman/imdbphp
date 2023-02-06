<?php

namespace GraphQL\SchemaObject;

class RootQueryObject extends QueryObject
{
    const OBJECT_NAME = "";

    public function selectPollsWorkaround()
    {
        $this->selectField("_pollsWorkaround");

        return $this;
    }

    public function selectAdvancedTitleSearch(RootAdvancedTitleSearchArgumentsObject $argsObject = null)
    {
        $object = new AdvancedTitleSearchConnectionQueryObject("advancedTitleSearch");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectBornToday(RootBornTodayArgumentsObject $argsObject = null)
    {
        $object = new NameSearchConnectionQueryObject("bornToday");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectBoxOfficeWeekendChart(RootBoxOfficeWeekendChartArgumentsObject $argsObject = null)
    {
        $object = new BoxOfficeWeekendChartQueryObject("boxOfficeWeekendChart");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectClaimedName(RootClaimedNameArgumentsObject $argsObject = null)
    {
        $object = new ClaimedNameQueryObject("claimedName");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectComingSoon(RootComingSoonArgumentsObject $argsObject = null)
    {
        $object = new TitleSearchConnectionQueryObject("comingSoon");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectCompanies(RootCompaniesArgumentsObject $argsObject = null)
    {
        $object = new CompanyQueryObject("companies");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectCompany(RootCompanyArgumentsObject $argsObject = null)
    {
        $object = new CompanyQueryObject("company");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectCompanyMetadata(RootCompanyMetadataArgumentsObject $argsObject = null)
    {
        $object = new CompanyMetadataQueryObject("companyMetadata");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectContributionQuestions(RootContributionQuestionsArgumentsObject $argsObject = null)
    {
        $object = new QuestionConnectionQueryObject("contributionQuestions");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectContributorLeaderboards(RootContributorLeaderboardsArgumentsObject $argsObject = null)
    {
        $object = new ContributorLeaderboardsQueryObject("contributorLeaderboards");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectContributorRankings(RootContributorRankingsArgumentsObject $argsObject = null)
    {
        $object = new ContributorLeaderboardRankConnectionQueryObject("contributorRankings");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectDisplayablePrompt(RootDisplayablePromptArgumentsObject $argsObject = null)
    {
        $object = new DisplayablePromptQueryObject("displayablePrompt");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectEventLiveResults(RootEventLiveResultsArgumentsObject $argsObject = null)
    {
        $object = new EventLiveResultsQueryObject("eventLiveResults");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectEventMetadata(RootEventMetadataArgumentsObject $argsObject = null)
    {
        $object = new EventMetadataQueryObject("eventMetadata");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectFanPicksTitles(RootFanPicksTitlesArgumentsObject $argsObject = null)
    {
        $object = new FanPicksConnectionQueryObject("fanPicksTitles");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectImage(RootImageArgumentsObject $argsObject = null)
    {
        $object = new ImageQueryObject("image");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectImageGalleries(RootImageGalleriesArgumentsObject $argsObject = null)
    {
        $object = new ImageGalleryQueryObject("imageGalleries");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectImageGallery(RootImageGalleryArgumentsObject $argsObject = null)
    {
        $object = new ImageGalleryQueryObject("imageGallery");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectImages(RootImagesArgumentsObject $argsObject = null)
    {
        $object = new ImageQueryObject("images");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectKeyword(RootKeywordArgumentsObject $argsObject = null)
    {
        $object = new KeywordQueryObject("keyword");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectKeywordMetadata(RootKeywordMetadataArgumentsObject $argsObject = null)
    {
        $object = new KeywordMetadataQueryObject("keywordMetadata");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectKeywords(RootKeywordsArgumentsObject $argsObject = null)
    {
        $object = new KeywordQueryObject("keywords");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectList(RootListArgumentsObject $argsObject = null)
    {
        $object = new ListQueryObject("list");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectLists(RootListsArgumentsObject $argsObject = null)
    {
        $object = new ListCollectionConnectionQueryObject("lists");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectLivingRoomFilterGame(RootLivingRoomFilterGameArgumentsObject $argsObject = null)
    {
        $object = new LivingRoomFilterGameResultsUnionObject("livingRoomFilterGame");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectLivingRoomGame(RootLivingRoomGameArgumentsObject $argsObject = null)
    {
        $object = new LivingRoomGameQueryObject("livingRoomGame");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectLivingRoomListGameTitles(RootLivingRoomListGameTitlesArgumentsObject $argsObject = null)
    {
        $object = new LivingRoomListGameTitleConnectionQueryObject("livingRoomListGameTitles");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectLivingRoomLobby(RootLivingRoomLobbyArgumentsObject $argsObject = null)
    {
        $object = new LivingRoomLobbyQueryObject("livingRoomLobby");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectMainSearch(RootMainSearchArgumentsObject $argsObject = null)
    {
        $object = new MainSearchConnectionQueryObject("mainSearch");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectName(RootNameArgumentsObject $argsObject = null)
    {
        $object = new NameQueryObject("name");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNameChartRankings(RootNameChartRankingsArgumentsObject $argsObject = null)
    {
        $object = new NameChartRankingsConnectionQueryObject("nameChartRankings");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNameManagingPermissionRequest(RootNameManagingPermissionRequestArgumentsObject $argsObject = null)
    {
        $object = new NameManagingPermissionRequestResponseQueryObject("nameManagingPermissionRequest");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNameMetadata(RootNameMetadataArgumentsObject $argsObject = null)
    {
        $object = new NameMetadataQueryObject("nameMetadata");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNames(RootNamesArgumentsObject $argsObject = null)
    {
        $object = new NameQueryObject("names");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNews(RootNewsArgumentsObject $argsObject = null)
    {
        $object = new NewsConnectionQueryObject("news");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNewsArticle(RootNewsArticleArgumentsObject $argsObject = null)
    {
        $object = new NewsQueryObject("newsArticle");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNewsSource(RootNewsSourceArgumentsObject $argsObject = null)
    {
        $object = new NewsSourceQueryObject("newsSource");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectOutstreamVideoAdApp()
    {
        $this->selectField("outstreamVideoAdApp");

        return $this;
    }

    public function selectPersistentLivingRoomGame(RootPersistentLivingRoomGameArgumentsObject $argsObject = null)
    {
        $object = new PersistentLivingRoomGameResultsUnionObject("persistentLivingRoomGame");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPopularTitles(RootPopularTitlesArgumentsObject $argsObject = null)
    {
        $object = new PaginatedTitlesQueryObject("popularTitles");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPredefinedList(RootPredefinedListArgumentsObject $argsObject = null)
    {
        $object = new ListQueryObject("predefinedList");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectProfessionNameTrackRecommendations(RootProfessionNameTrackRecommendationsArgumentsObject $argsObject = null)
    {
        $object = new NameTrackRecommendationsConnectionQueryObject("professionNameTrackRecommendations");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectProfessionTitleTrackRecommendations(RootProfessionTitleTrackRecommendationsArgumentsObject $argsObject = null)
    {
        $object = new TitleTrackRecommendationsConnectionQueryObject("professionTitleTrackRecommendations");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPushNotificationUserSettings(RootPushNotificationUserSettingsArgumentsObject $argsObject = null)
    {
        $object = new PushNotificationUserSettingsQueryObject("pushNotificationUserSettings");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectRecentVideos(RootRecentVideosArgumentsObject $argsObject = null)
    {
        $object = new PaginatedVideosQueryObject("recentVideos");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectRecentlyViewedItems(RootRecentlyViewedItemsArgumentsObject $argsObject = null)
    {
        $object = new RecentlyViewedConnectionQueryObject("recentlyViewedItems");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectRenderedMarkdown(RootRenderedMarkdownArgumentsObject $argsObject = null)
    {
        $object = new MarkdownQueryObject("renderedMarkdown");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectReview(RootReviewArgumentsObject $argsObject = null)
    {
        $object = new ReviewQueryObject("review");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectSearchMetadata(RootSearchMetadataArgumentsObject $argsObject = null)
    {
        $object = new SearchMetadataQueryObject("searchMetadata");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectSelfVerifiedNameMetadata(RootSelfVerifiedNameMetadataArgumentsObject $argsObject = null)
    {
        $object = new SelfVerifiedNameMetadataQueryObject("selfVerifiedNameMetadata");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectShowtimesTitles(RootShowtimesTitlesArgumentsObject $argsObject = null)
    {
        $object = new ShowtimesTitleConnectionQueryObject("showtimesTitles");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectSimilarNameTrackRecommendations(RootSimilarNameTrackRecommendationsArgumentsObject $argsObject = null)
    {
        $object = new NameTrackRecommendationsConnectionQueryObject("similarNameTrackRecommendations");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectSimilarTitleTrackRecommendations(RootSimilarTitleTrackRecommendationsArgumentsObject $argsObject = null)
    {
        $object = new TitleTrackRecommendationsConnectionQueryObject("similarTitleTrackRecommendations");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectStreamingTitles(RootStreamingTitlesArgumentsObject $argsObject = null)
    {
        $object = new StreamingTitlesQueryObject("streamingTitles");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectStubQuery(RootStubQueryArgumentsObject $argsObject = null)
    {
        $object = new QueryStubsQueryObject("stubQuery");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectSuggestionSearch(RootSuggestionSearchArgumentsObject $argsObject = null)
    {
        $object = new SuggestionSearchConnectionQueryObject("suggestionSearch");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTest(RootTestArgumentsObject $argsObject = null)
    {
        $object = new TestQueryObject("test");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTestAuth(RootTestAuthArgumentsObject $argsObject = null)
    {
        $object = new TestAuthQueryObject("testAuth");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTestAuthTimer(RootTestAuthTimerArgumentsObject $argsObject = null)
    {
        $object = new TestAuthTimerQueryObject("testAuthTimer");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTitle(RootTitleArgumentsObject $argsObject = null)
    {
        $object = new TitleQueryObject("title");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTitleChartRankings(RootTitleChartRankingsArgumentsObject $argsObject = null)
    {
        $object = new TitleChartRankingsConnectionQueryObject("titleChartRankings");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTitleMetadata(RootTitleMetadataArgumentsObject $argsObject = null)
    {
        $object = new TitleMetadataQueryObject("titleMetadata");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTitleRecommendations(RootTitleRecommendationsArgumentsObject $argsObject = null)
    {
        $object = new TitleRecommendationConnectionQueryObject("titleRecommendations");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTitles(RootTitlesArgumentsObject $argsObject = null)
    {
        $object = new TitleQueryObject("titles");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTopListsForItem(RootTopListsForItemArgumentsObject $argsObject = null)
    {
        $object = new ListCollectionConnectionQueryObject("topListsForItem");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTopMeterNames(RootTopMeterNamesArgumentsObject $argsObject = null)
    {
        $object = new NameSearchConnectionQueryObject("topMeterNames");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTopMeterTitles(RootTopMeterTitlesArgumentsObject $argsObject = null)
    {
        $object = new TitleSearchConnectionQueryObject("topMeterTitles");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTopPicksTitles(RootTopPicksTitlesArgumentsObject $argsObject = null)
    {
        $object = new TopPicksConnectionQueryObject("topPicksTitles");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTopTrendingNames(RootTopTrendingNamesArgumentsObject $argsObject = null)
    {
        $object = new TrendingNameConnectionQueryObject("topTrendingNames");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTopTrendingSetsPredefined(RootTopTrendingSetsPredefinedArgumentsObject $argsObject = null)
    {
        $object = new TrendingTitleConnectionQueryObject("topTrendingSetsPredefined");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTopTrendingTitles(RootTopTrendingTitlesArgumentsObject $argsObject = null)
    {
        $object = new TrendingTitleConnectionQueryObject("topTrendingTitles");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTopTrendingVideos(RootTopTrendingVideosArgumentsObject $argsObject = null)
    {
        $object = new TrendingVideoConnectionQueryObject("topTrendingVideos");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTrackedNames(RootTrackedNamesArgumentsObject $argsObject = null)
    {
        $object = new TrackedNamesConnectionQueryObject("trackedNames");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTrackedTitles(RootTrackedTitlesArgumentsObject $argsObject = null)
    {
        $object = new TrackedTitlesConnectionQueryObject("trackedTitles");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTrendingNamesCollectionOptions(RootTrendingNamesCollectionOptionsArgumentsObject $argsObject = null)
    {
        $object = new TrendingNameCollectionOptionsQueryObject("trendingNamesCollectionOptions");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTrendingTitles(RootTrendingTitlesArgumentsObject $argsObject = null)
    {
        $object = new PaginatedTitlesQueryObject("trendingTitles");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTrendingTitlesCollectionOptions(RootTrendingTitlesCollectionOptionsArgumentsObject $argsObject = null)
    {
        $object = new TrendingTitleCollectionOptionsQueryObject("trendingTitlesCollectionOptions");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectUnreleasedTitleTrackRecommendations(RootUnreleasedTitleTrackRecommendationsArgumentsObject $argsObject = null)
    {
        $object = new TitleTrackRecommendationsConnectionQueryObject("unreleasedTitleTrackRecommendations");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectUser(RootUserArgumentsObject $argsObject = null)
    {
        $object = new UserQueryObject("user");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectUserConsent(RootUserConsentArgumentsObject $argsObject = null)
    {
        $object = new UserConsentOutputQueryObject("userConsent");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectUserProfileByUserId(RootUserProfileByUserIdArgumentsObject $argsObject = null)
    {
        $object = new UserProfileQueryObject("userProfileByUserId");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectVanityUrl(RootVanityUrlArgumentsObject $argsObject = null)
    {
        $object = new VanityUrlQueryObject("vanityUrl");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectVideo(RootVideoArgumentsObject $argsObject = null)
    {
        $object = new VideoQueryObject("video");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectVideos(RootVideosArgumentsObject $argsObject = null)
    {
        $object = new VideoQueryObject("videos");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectWatchProviders(RootWatchProvidersArgumentsObject $argsObject = null)
    {
        $object = new WatchProviderConnectionQueryObject("watchProviders");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
