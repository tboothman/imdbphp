<?php

namespace GraphQL\SchemaObject;

class CrazyCreditQueryObject extends QueryObject
{
    const OBJECT_NAME = "CrazyCredit";

    public function selectDisplayableArticle(CrazyCreditDisplayableArticleArgumentsObject $argsObject = null)
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

    public function selectInterestScore(CrazyCreditInterestScoreArgumentsObject $argsObject = null)
    {
        $object = new InterestScoreQueryObject("interestScore");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectText(CrazyCreditTextArgumentsObject $argsObject = null)
    {
        $object = new MarkdownQueryObject("text");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
