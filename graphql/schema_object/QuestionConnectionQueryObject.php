<?php

namespace GraphQL\SchemaObject;

class QuestionConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "QuestionConnection";

    public function selectContributionLink(QuestionConnectionContributionLinkArgumentsObject $argsObject = null)
    {
        $object = new ContributionQuestionsLinkQueryObject("contributionLink");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectEdges(QuestionConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new QuestionEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(QuestionConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectSupportedFilters(QuestionConnectionSupportedFiltersArgumentsObject $argsObject = null)
    {
        $object = new SupportedQuestionFiltersQueryObject("supportedFilters");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
