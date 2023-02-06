<?php

namespace GraphQL\SchemaObject;

class NameManagedDataQueryObject extends QueryObject
{
    const OBJECT_NAME = "NameManagedData";

    public function selectAutomaticFeaturedImages(NameManagedDataAutomaticFeaturedImagesArgumentsObject $argsObject = null)
    {
        $object = new ImageQueryObject("automaticFeaturedImages");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectAutomaticKnownFor(NameManagedDataAutomaticKnownForArgumentsObject $argsObject = null)
    {
        $object = new TitleQueryObject("automaticKnownFor");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectAutomaticPrimaryProfessions(NameManagedDataAutomaticPrimaryProfessionsArgumentsObject $argsObject = null)
    {
        $object = new PrimaryProfessionQueryObject("automaticPrimaryProfessions");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectCustomFeaturedImages(NameManagedDataCustomFeaturedImagesArgumentsObject $argsObject = null)
    {
        $object = new CustomFeaturedImagesQueryObject("customFeaturedImages");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectCustomKnownFor(NameManagedDataCustomKnownForArgumentsObject $argsObject = null)
    {
        $object = new CustomKnownForQueryObject("customKnownFor");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectCustomPrimaryProfessions(NameManagedDataCustomPrimaryProfessionsArgumentsObject $argsObject = null)
    {
        $object = new CustomPrimaryProfessionsQueryObject("customPrimaryProfessions");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectDisplayPreferences(NameManagedDataDisplayPreferencesArgumentsObject $argsObject = null)
    {
        $object = new NameDisplayPreferencesQueryObject("displayPreferences");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectLatestPrimaryImage(NameManagedDataLatestPrimaryImageArgumentsObject $argsObject = null)
    {
        $object = new ImageQueryObject("latestPrimaryImage");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectManagedClients(NameManagedDataManagedClientsArgumentsObject $argsObject = null)
    {
        $object = new ManagedClientQueryObject("managedClients");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectManagingRepresentatives(NameManagedDataManagingRepresentativesArgumentsObject $argsObject = null)
    {
        $object = new ManagingRepresentativeQueryObject("managingRepresentatives");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
