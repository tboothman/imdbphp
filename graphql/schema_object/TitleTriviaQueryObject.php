<?php

namespace GraphQL\SchemaObject;

class TitleTriviaQueryObject extends QueryObject
{
    const OBJECT_NAME = "TitleTrivia";

    public function selectCategory(TitleTriviaCategoryArgumentsObject $argsObject = null)
    {
        $object = new TriviaCategoryQueryObject("category");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectCorrectionLink(TitleTriviaCorrectionLinkArgumentsObject $argsObject = null)
    {
        $object = new ContributionLinkQueryObject("correctionLink");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectDisplayableArticle(TitleTriviaDisplayableArticleArgumentsObject $argsObject = null)
    {
        $object = new DisplayableArticleQueryObject("displayableArticle");
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

    public function selectInterestScore(TitleTriviaInterestScoreArgumentsObject $argsObject = null)
    {
        $object = new InterestScoreQueryObject("interestScore");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectIsSpoiler()
    {
        $this->selectField("isSpoiler");

        return $this;
    }

    public function selectRelatedNames(TitleTriviaRelatedNamesArgumentsObject $argsObject = null)
    {
        $object = new NameQueryObject("relatedNames");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectReportingLink(TitleTriviaReportingLinkArgumentsObject $argsObject = null)
    {
        $object = new ContributionLinkQueryObject("reportingLink");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectText(TitleTriviaTextArgumentsObject $argsObject = null)
    {
        $object = new MarkdownQueryObject("text");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTitle(TitleTriviaTitleArgumentsObject $argsObject = null)
    {
        $object = new TitleQueryObject("title");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTrademark(TitleTriviaTrademarkArgumentsObject $argsObject = null)
    {
        $object = new MarkdownQueryObject("trademark");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
