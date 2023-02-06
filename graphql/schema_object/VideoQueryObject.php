<?php

namespace GraphQL\SchemaObject;

class VideoQueryObject extends QueryObject
{
    const OBJECT_NAME = "Video";

    public function selectAppAdURL()
    {
        $this->selectField("appAdURL");

        return $this;
    }

    public function selectContentType(VideoContentTypeArgumentsObject $argsObject = null)
    {
        $object = new VideoContentTypeQueryObject("contentType");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectCreatedDate()
    {
        $this->selectField("createdDate");

        return $this;
    }

    public function selectDescription(VideoDescriptionArgumentsObject $argsObject = null)
    {
        $object = new LocalizedStringQueryObject("description");
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

    public function selectIsMature()
    {
        $this->selectField("isMature");

        return $this;
    }

    public function selectName(VideoNameArgumentsObject $argsObject = null)
    {
        $object = new LocalizedStringQueryObject("name");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPersonalizedSuggestedVideos(VideoPersonalizedSuggestedVideosArgumentsObject $argsObject = null)
    {
        $object = new PersonalizedSuggestedVideosConnectionQueryObject("personalizedSuggestedVideos");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPlaybackURLs(VideoPlaybackURLsArgumentsObject $argsObject = null)
    {
        $object = new PlaybackURLQueryObject("playbackURLs");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPreviewURLs(VideoPreviewURLsArgumentsObject $argsObject = null)
    {
        $object = new PlaybackURLQueryObject("previewURLs");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPrimaryTitle(VideoPrimaryTitleArgumentsObject $argsObject = null)
    {
        $object = new TitleQueryObject("primaryTitle");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectProviderType(VideoProviderTypeArgumentsObject $argsObject = null)
    {
        $object = new VideoProviderTypeQueryObject("providerType");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectRecommendedTimedTextTrack(VideoRecommendedTimedTextTrackArgumentsObject $argsObject = null)
    {
        $object = new VideoTimedTextTrackQueryObject("recommendedTimedTextTrack");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectRelatedVideos(VideoRelatedVideosArgumentsObject $argsObject = null)
    {
        $object = new VideoConnectionQueryObject("relatedVideos");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectRuntime(VideoRuntimeArgumentsObject $argsObject = null)
    {
        $object = new VideoRuntimeQueryObject("runtime");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectThumbnail(VideoThumbnailArgumentsObject $argsObject = null)
    {
        $object = new ThumbnailQueryObject("thumbnail");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTimedTextTracks(VideoTimedTextTracksArgumentsObject $argsObject = null)
    {
        $object = new VideoTimedTextTrackQueryObject("timedTextTracks");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectWebAdURL()
    {
        $this->selectField("webAdURL");

        return $this;
    }
}
