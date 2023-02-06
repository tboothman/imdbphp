<?php

namespace GraphQL\SchemaObject;

class CompanyQueryObject extends QueryObject
{
    const OBJECT_NAME = "Company";

    public function selectAcronyms(CompanyAcronymsArgumentsObject $argsObject = null)
    {
        $object = new CompanyAcronymConnectionQueryObject("acronyms");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectAffiliations(CompanyAffiliationsArgumentsObject $argsObject = null)
    {
        $object = new CompanyAffiliationConnectionQueryObject("affiliations");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectBio(CompanyBioArgumentsObject $argsObject = null)
    {
        $object = new CompanyBioQueryObject("bio");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectCompanyText(CompanyCompanyTextArgumentsObject $argsObject = null)
    {
        $object = new CompanyTextQueryObject("companyText");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectCompanyTypes(CompanyCompanyTypesArgumentsObject $argsObject = null)
    {
        $object = new CompanyTypeQueryObject("companyTypes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectCountry(CompanyCountryArgumentsObject $argsObject = null)
    {
        $object = new LocalizedDisplayableCountryQueryObject("country");
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

    public function selectKeyStaff(CompanyKeyStaffArgumentsObject $argsObject = null)
    {
        $object = new CompanyKeyStaffConnectionQueryObject("keyStaff");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectKnownForClients(CompanyKnownForClientsArgumentsObject $argsObject = null)
    {
        $object = new CompanyKnownForClientConnectionQueryObject("knownForClients");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectKnownForTitles(CompanyKnownForTitlesArgumentsObject $argsObject = null)
    {
        $object = new CompanyKnownForTitleConnectionQueryObject("knownForTitles");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectManagedData(CompanyManagedDataArgumentsObject $argsObject = null)
    {
        $object = new ManagedCompanyDataQueryObject("managedData");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectMeterRanking(CompanyMeterRankingArgumentsObject $argsObject = null)
    {
        $object = new CompanyMeterRankingQueryObject("meterRanking");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectMeterRankingHistory(CompanyMeterRankingHistoryArgumentsObject $argsObject = null)
    {
        $object = new CompanyMeterRankingHistoryQueryObject("meterRankingHistory");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPrimaryImage(CompanyPrimaryImageArgumentsObject $argsObject = null)
    {
        $object = new ImageQueryObject("primaryImage");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
