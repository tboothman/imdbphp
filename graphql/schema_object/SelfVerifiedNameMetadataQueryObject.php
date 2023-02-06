<?php

namespace GraphQL\SchemaObject;

class SelfVerifiedNameMetadataQueryObject extends QueryObject
{
    const OBJECT_NAME = "SelfVerifiedNameMetadata";

    public function selectAccent(SelfVerifiedNameMetadataAccentArgumentsObject $argsObject = null)
    {
        $object = new SelfVerifiedNameAttributeMetadataQueryObject("accent");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectAthleticSkill(SelfVerifiedNameMetadataAthleticSkillArgumentsObject $argsObject = null)
    {
        $object = new SelfVerifiedNameAttributeMetadataQueryObject("athleticSkill");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectAward(SelfVerifiedNameMetadataAwardArgumentsObject $argsObject = null)
    {
        $object = new SelfVerifiedNameAttributeMetadataQueryObject("award");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectCredit(SelfVerifiedNameMetadataCreditArgumentsObject $argsObject = null)
    {
        $object = new SelfVerifiedNameCreditMetadataQueryObject("credit");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectDanceSkill(SelfVerifiedNameMetadataDanceSkillArgumentsObject $argsObject = null)
    {
        $object = new SelfVerifiedNameAttributeMetadataQueryObject("danceSkill");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectEducationalHistory(SelfVerifiedNameMetadataEducationalHistoryArgumentsObject $argsObject = null)
    {
        $object = new SelfVerifiedNameAttributeMetadataQueryObject("educationalHistory");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectEthnicAppearance(SelfVerifiedNameMetadataEthnicAppearanceArgumentsObject $argsObject = null)
    {
        $object = new SelfVerifiedNameAttributeMetadataQueryObject("ethnicAppearance");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectEyeColor(SelfVerifiedNameMetadataEyeColorArgumentsObject $argsObject = null)
    {
        $object = new SelfVerifiedNameAttributeMetadataQueryObject("eyeColor");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectGuildAffiliation(SelfVerifiedNameMetadataGuildAffiliationArgumentsObject $argsObject = null)
    {
        $object = new SelfVerifiedNameAttributeMetadataQueryObject("guildAffiliation");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectHairColor(SelfVerifiedNameMetadataHairColorArgumentsObject $argsObject = null)
    {
        $object = new SelfVerifiedNameAttributeMetadataQueryObject("hairColor");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectHairLength(SelfVerifiedNameMetadataHairLengthArgumentsObject $argsObject = null)
    {
        $object = new SelfVerifiedNameAttributeMetadataQueryObject("hairLength");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectJobCategory(SelfVerifiedNameMetadataJobCategoryArgumentsObject $argsObject = null)
    {
        $object = new SelfVerifiedNameAttributeMetadataQueryObject("jobCategory");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectJobTitle(SelfVerifiedNameMetadataJobTitleArgumentsObject $argsObject = null)
    {
        $object = new SelfVerifiedNameAttributeMetadataQueryObject("jobTitle");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectMusicalInstrument(SelfVerifiedNameMetadataMusicalInstrumentArgumentsObject $argsObject = null)
    {
        $object = new SelfVerifiedNameAttributeMetadataQueryObject("musicalInstrument");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPerformerSkill(SelfVerifiedNameMetadataPerformerSkillArgumentsObject $argsObject = null)
    {
        $object = new SelfVerifiedNameAttributeMetadataQueryObject("performerSkill");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPersonalLocation(SelfVerifiedNameMetadataPersonalLocationArgumentsObject $argsObject = null)
    {
        $object = new NamePersonalLocationMetadataQueryObject("personalLocation");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPhysique(SelfVerifiedNameMetadataPhysiqueArgumentsObject $argsObject = null)
    {
        $object = new SelfVerifiedNameAttributeMetadataQueryObject("physique");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPrimaryCitizenship(SelfVerifiedNameMetadataPrimaryCitizenshipArgumentsObject $argsObject = null)
    {
        $object = new CountryAttributeMetadataQueryObject("primaryCitizenship");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectReference(SelfVerifiedNameMetadataReferenceArgumentsObject $argsObject = null)
    {
        $object = new SelfVerifiedNameAttributeMetadataQueryObject("reference");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectResumeCustomSection(SelfVerifiedNameMetadataResumeCustomSectionArgumentsObject $argsObject = null)
    {
        $object = new SelfVerifiedNameAttributeMetadataQueryObject("resumeCustomSection");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectSpokenLanguage(SelfVerifiedNameMetadataSpokenLanguageArgumentsObject $argsObject = null)
    {
        $object = new SelfVerifiedNameAttributeMetadataQueryObject("spokenLanguage");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTraining(SelfVerifiedNameMetadataTrainingArgumentsObject $argsObject = null)
    {
        $object = new SelfVerifiedNameAttributeMetadataQueryObject("training");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectUniqueTrait(SelfVerifiedNameMetadataUniqueTraitArgumentsObject $argsObject = null)
    {
        $object = new SelfVerifiedNameAttributeMetadataQueryObject("uniqueTrait");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectVoiceType(SelfVerifiedNameMetadataVoiceTypeArgumentsObject $argsObject = null)
    {
        $object = new SelfVerifiedNameAttributeMetadataQueryObject("voiceType");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectWorkAuthorizationCountry(SelfVerifiedNameMetadataWorkAuthorizationCountryArgumentsObject $argsObject = null)
    {
        $object = new CountryAttributeMetadataQueryObject("workAuthorizationCountry");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectWorkHistoryCreditType(SelfVerifiedNameMetadataWorkHistoryCreditTypeArgumentsObject $argsObject = null)
    {
        $object = new SelfVerifiedNameAttributeMetadataQueryObject("workHistoryCreditType");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
