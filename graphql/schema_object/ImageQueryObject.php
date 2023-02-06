<?php

namespace GraphQL\SchemaObject;

class ImageQueryObject extends QueryObject
{
    const OBJECT_NAME = "Image";

    public function selectCaption(ImageCaptionArgumentsObject $argsObject = null)
    {
        $object = new MarkdownQueryObject("caption");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectCopyright()
    {
        $this->selectField("copyright");

        return $this;
    }

    public function selectCorrectionLink(ImageCorrectionLinkArgumentsObject $argsObject = null)
    {
        $object = new ContributionLinkQueryObject("correctionLink");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectCountries(ImageCountriesArgumentsObject $argsObject = null)
    {
        $object = new DisplayableCountryQueryObject("countries");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectCreatedBy()
    {
        $this->selectField("createdBy");

        return $this;
    }

    public function selectCreatedOn(ImageCreatedOnArgumentsObject $argsObject = null)
    {
        $object = new DisplayableDateQueryObject("createdOn");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectHeight()
    {
        $this->selectField("height");

        return $this;
    }

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectLanguages(ImageLanguagesArgumentsObject $argsObject = null)
    {
        $object = new DisplayableLanguageQueryObject("languages");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNames(ImageNamesArgumentsObject $argsObject = null)
    {
        $object = new NameQueryObject("names");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectReportingLink(ImageReportingLinkArgumentsObject $argsObject = null)
    {
        $object = new ContributionLinkQueryObject("reportingLink");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectSource(ImageSourceArgumentsObject $argsObject = null)
    {
        $object = new SourceQueryObject("source");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTitles(ImageTitlesArgumentsObject $argsObject = null)
    {
        $object = new TitleQueryObject("titles");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectType()
    {
        $this->selectField("type");

        return $this;
    }

    public function selectUrl()
    {
        $this->selectField("url");

        return $this;
    }

    public function selectWidth()
    {
        $this->selectField("width");

        return $this;
    }
}
