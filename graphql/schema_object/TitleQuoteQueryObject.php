<?php

namespace GraphQL\SchemaObject;

class TitleQuoteQueryObject extends QueryObject
{
    const OBJECT_NAME = "TitleQuote";

    public function selectDisplayableArticle(TitleQuoteDisplayableArticleArgumentsObject $argsObject = null)
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

    public function selectInterestScore(TitleQuoteInterestScoreArgumentsObject $argsObject = null)
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

    public function selectLanguage(TitleQuoteLanguageArgumentsObject $argsObject = null)
    {
        $object = new DisplayableLanguageQueryObject("language");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectLines(TitleQuoteLinesArgumentsObject $argsObject = null)
    {
        $object = new TitleQuoteLineQueryObject("lines");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
