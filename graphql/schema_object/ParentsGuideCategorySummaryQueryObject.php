<?php

namespace GraphQL\SchemaObject;

class ParentsGuideCategorySummaryQueryObject extends QueryObject
{
    const OBJECT_NAME = "ParentsGuideCategorySummary";

    public function selectCategory(ParentsGuideCategorySummaryCategoryArgumentsObject $argsObject = null)
    {
        $object = new ParentsGuideCategoryQueryObject("category");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectGuideItems(ParentsGuideCategorySummaryGuideItemsArgumentsObject $argsObject = null)
    {
        $object = new ParentsGuideConnectionQueryObject("guideItems");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectSeverity(ParentsGuideCategorySummarySeverityArgumentsObject $argsObject = null)
    {
        $object = new SeverityLevelQueryObject("severity");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectSeverityBreakdown(ParentsGuideCategorySummarySeverityBreakdownArgumentsObject $argsObject = null)
    {
        $object = new SeverityLevelQueryObject("severityBreakdown");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTotalSeverityVotes()
    {
        $this->selectField("totalSeverityVotes");

        return $this;
    }
}
