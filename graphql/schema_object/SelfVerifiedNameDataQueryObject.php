<?php

namespace GraphQL\SchemaObject;

class SelfVerifiedNameDataQueryObject extends QueryObject
{
    const OBJECT_NAME = "SelfVerifiedNameData";

    public function selectAccents(SelfVerifiedNameDataAccentsArgumentsObject $argsObject = null)
    {
        $object = new SelfVerifiedNameAttributeQueryObject("accents");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectAgePlayingRange(SelfVerifiedNameDataAgePlayingRangeArgumentsObject $argsObject = null)
    {
        $object = new AgePlayingRangeQueryObject("agePlayingRange");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectAthleticSkills(SelfVerifiedNameDataAthleticSkillsArgumentsObject $argsObject = null)
    {
        $object = new SelfVerifiedNameAttributeQueryObject("athleticSkills");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectAwards(SelfVerifiedNameDataAwardsArgumentsObject $argsObject = null)
    {
        $object = new SelfVerifiedNameAwardConnectionQueryObject("awards");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectBlog(SelfVerifiedNameDataBlogArgumentsObject $argsObject = null)
    {
        $object = new BlogLinkQueryObject("blog");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectCreditTypes(SelfVerifiedNameDataCreditTypesArgumentsObject $argsObject = null)
    {
        $object = new SelfVerifiedNameCreditTypeWithCreditsQueryObject("creditTypes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectDanceSkills(SelfVerifiedNameDataDanceSkillsArgumentsObject $argsObject = null)
    {
        $object = new SelfVerifiedNameAttributeQueryObject("danceSkills");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectEducationalHistory(SelfVerifiedNameDataEducationalHistoryArgumentsObject $argsObject = null)
    {
        $object = new SelfVerifiedNameEducationalHistoryConnectionQueryObject("educationalHistory");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectEthnicAppearances(SelfVerifiedNameDataEthnicAppearancesArgumentsObject $argsObject = null)
    {
        $object = new SelfVerifiedNameAttributeQueryObject("ethnicAppearances");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectEyeColor(SelfVerifiedNameDataEyeColorArgumentsObject $argsObject = null)
    {
        $object = new SelfVerifiedNameAttributeValueQueryObject("eyeColor");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectGuildAffiliations(SelfVerifiedNameDataGuildAffiliationsArgumentsObject $argsObject = null)
    {
        $object = new SelfVerifiedNameAttributeQueryObject("guildAffiliations");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectHairColor(SelfVerifiedNameDataHairColorArgumentsObject $argsObject = null)
    {
        $object = new SelfVerifiedNameAttributeValueQueryObject("hairColor");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectHairLength(SelfVerifiedNameDataHairLengthArgumentsObject $argsObject = null)
    {
        $object = new SelfVerifiedNameAttributeValueQueryObject("hairLength");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectHasValidPassport()
    {
        $this->selectField("hasValidPassport");

        return $this;
    }

    public function selectIsWillingToWorkUnpaid()
    {
        $this->selectField("isWillingToWorkUnpaid");

        return $this;
    }

    public function selectJobCategories(SelfVerifiedNameDataJobCategoriesArgumentsObject $argsObject = null)
    {
        $object = new SelfVerifiedNameAttributeQueryObject("jobCategories");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectJobTitles(SelfVerifiedNameDataJobTitlesArgumentsObject $argsObject = null)
    {
        $object = new SelfVerifiedNameAttributeQueryObject("jobTitles");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectMusicalInstruments(SelfVerifiedNameDataMusicalInstrumentsArgumentsObject $argsObject = null)
    {
        $object = new SelfVerifiedNameAttributeQueryObject("musicalInstruments");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPerformerSkills(SelfVerifiedNameDataPerformerSkillsArgumentsObject $argsObject = null)
    {
        $object = new SelfVerifiedNameAttributeQueryObject("performerSkills");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPersonalLocations(SelfVerifiedNameDataPersonalLocationsArgumentsObject $argsObject = null)
    {
        $object = new NamePersonalLocationsQueryObject("personalLocations");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPhysique(SelfVerifiedNameDataPhysiqueArgumentsObject $argsObject = null)
    {
        $object = new SelfVerifiedNameAttributeValueQueryObject("physique");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPrimaryCitizenship(SelfVerifiedNameDataPrimaryCitizenshipArgumentsObject $argsObject = null)
    {
        $object = new LocalizedDisplayableCountryQueryObject("primaryCitizenship");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectReferences(SelfVerifiedNameDataReferencesArgumentsObject $argsObject = null)
    {
        $object = new SelfVerifiedNameReferenceConnectionQueryObject("references");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectResumeCustomSections(SelfVerifiedNameDataResumeCustomSectionsArgumentsObject $argsObject = null)
    {
        $object = new SelfVerifiedResumeCustomSectionConnectionQueryObject("resumeCustomSections");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectResumeDetails(SelfVerifiedNameDataResumeDetailsArgumentsObject $argsObject = null)
    {
        $object = new SelfVerifiedNameAttributeValueQueryObject("resumeDetails");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectSpokenLanguages(SelfVerifiedNameDataSpokenLanguagesArgumentsObject $argsObject = null)
    {
        $object = new SelfVerifiedNameAttributeQueryObject("spokenLanguages");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTrainings(SelfVerifiedNameDataTrainingsArgumentsObject $argsObject = null)
    {
        $object = new SelfVerifiedNameTrainingConnectionQueryObject("trainings");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTwitter(SelfVerifiedNameDataTwitterArgumentsObject $argsObject = null)
    {
        $object = new TwitterLinkQueryObject("twitter");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectUniqueTraits(SelfVerifiedNameDataUniqueTraitsArgumentsObject $argsObject = null)
    {
        $object = new SelfVerifiedNameAttributeQueryObject("uniqueTraits");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectVoiceTypes(SelfVerifiedNameDataVoiceTypesArgumentsObject $argsObject = null)
    {
        $object = new SelfVerifiedNameAttributeQueryObject("voiceTypes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectWeight(SelfVerifiedNameDataWeightArgumentsObject $argsObject = null)
    {
        $object = new NameWeightQueryObject("weight");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectWorkAuthorizationCountries(SelfVerifiedNameDataWorkAuthorizationCountriesArgumentsObject $argsObject = null)
    {
        $object = new WorkAuthorizationCountriesQueryObject("workAuthorizationCountries");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectWorkHistoryCreditTypes(SelfVerifiedNameDataWorkHistoryCreditTypesArgumentsObject $argsObject = null)
    {
        $object = new SelfVerifiedNameAttributeQueryObject("workHistoryCreditTypes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
