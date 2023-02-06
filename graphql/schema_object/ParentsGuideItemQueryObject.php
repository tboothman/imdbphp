<?php

namespace GraphQL\SchemaObject;

class ParentsGuideItemQueryObject extends QueryObject
{
    const OBJECT_NAME = "ParentsGuideItem";

    public function selectCategory(ParentsGuideItemCategoryArgumentsObject $argsObject = null)
    {
        $object = new ParentsGuideCategoryQueryObject("category");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectCorrectionLink(ParentsGuideItemCorrectionLinkArgumentsObject $argsObject = null)
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

    public function selectReportingLink(ParentsGuideItemReportingLinkArgumentsObject $argsObject = null)
    {
        $object = new ContributionLinkQueryObject("reportingLink");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectText(ParentsGuideItemTextArgumentsObject $argsObject = null)
    {
        $object = new MarkdownQueryObject("text");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTitle(ParentsGuideItemTitleArgumentsObject $argsObject = null)
    {
        $object = new TitleQueryObject("title");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
