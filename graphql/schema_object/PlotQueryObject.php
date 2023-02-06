<?php

namespace GraphQL\SchemaObject;

class PlotQueryObject extends QueryObject
{
    const OBJECT_NAME = "Plot";

    public function selectAuthor()
    {
        $this->selectField("author");

        return $this;
    }

    public function selectCorrectionLink(PlotCorrectionLinkArgumentsObject $argsObject = null)
    {
        $object = new ContributionLinkQueryObject("correctionLink");
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

    public function selectIsSpoiler()
    {
        $this->selectField("isSpoiler");

        return $this;
    }

    public function selectLanguage(PlotLanguageArgumentsObject $argsObject = null)
    {
        $object = new DisplayableLanguageQueryObject("language");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPlotText(PlotPlotTextArgumentsObject $argsObject = null)
    {
        $object = new MarkdownQueryObject("plotText");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPlotType()
    {
        $this->selectField("plotType");

        return $this;
    }

    public function selectReportingLink(PlotReportingLinkArgumentsObject $argsObject = null)
    {
        $object = new ContributionLinkQueryObject("reportingLink");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectRestriction(PlotRestrictionArgumentsObject $argsObject = null)
    {
        $object = new PlotRestrictionQueryObject("restriction");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTitle(PlotTitleArgumentsObject $argsObject = null)
    {
        $object = new TitleQueryObject("title");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
