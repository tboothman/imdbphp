<?php

namespace GraphQL\SchemaObject;

class CompanyCreditQueryObject extends QueryObject
{
    const OBJECT_NAME = "CompanyCredit";

    public function selectAttributes(CompanyCreditAttributesArgumentsObject $argsObject = null)
    {
        $object = new DisplayableAttributeQueryObject("attributes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectCategory(CompanyCreditCategoryArgumentsObject $argsObject = null)
    {
        $object = new CompanyCreditCategoryQueryObject("category");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectCompany(CompanyCreditCompanyArgumentsObject $argsObject = null)
    {
        $object = new CompanyQueryObject("company");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectCountries(CompanyCreditCountriesArgumentsObject $argsObject = null)
    {
        $object = new DisplayableCountryQueryObject("countries");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectDisplayableProperty(CompanyCreditDisplayablePropertyArgumentsObject $argsObject = null)
    {
        $object = new DisplayableTitleCompanyCreditPropertyQueryObject("displayableProperty");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectDistributionFormats(CompanyCreditDistributionFormatsArgumentsObject $argsObject = null)
    {
        $object = new DistributionFormatQueryObject("distributionFormats");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTitle(CompanyCreditTitleArgumentsObject $argsObject = null)
    {
        $object = new TitleQueryObject("title");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectYearsInvolved(CompanyCreditYearsInvolvedArgumentsObject $argsObject = null)
    {
        $object = new YearRangeQueryObject("yearsInvolved");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
