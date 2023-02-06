<?php

namespace GraphQL\SchemaObject;

class ExternalLinkQueryObject extends QueryObject
{
    const OBJECT_NAME = "ExternalLink";

    public function selectDisplayableProperty(ExternalLinkDisplayablePropertyArgumentsObject $argsObject = null)
    {
        $object = new DisplayableExternalLinkPropertyQueryObject("displayableProperty");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectExternalLinkCategory(ExternalLinkExternalLinkCategoryArgumentsObject $argsObject = null)
    {
        $object = new ExternalLinkCategoryQueryObject("externalLinkCategory");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectExternalLinkLanguages(ExternalLinkExternalLinkLanguagesArgumentsObject $argsObject = null)
    {
        $object = new DisplayableLanguageQueryObject("externalLinkLanguages");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectExternalLinkRegion(ExternalLinkExternalLinkRegionArgumentsObject $argsObject = null)
    {
        $object = new DisplayableCountryQueryObject("externalLinkRegion");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectLabel()
    {
        $this->selectField("label");

        return $this;
    }

    public function selectLabelLanguage(ExternalLinkLabelLanguageArgumentsObject $argsObject = null)
    {
        $object = new DisplayableLanguageQueryObject("labelLanguage");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectUrl()
    {
        $this->selectField("url");

        return $this;
    }
}
