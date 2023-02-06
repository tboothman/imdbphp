<?php

namespace GraphQL\SchemaObject;

class MetacriticReviewQueryObject extends QueryObject
{
    const OBJECT_NAME = "MetacriticReview";

    public function selectQuote(MetacriticReviewQuoteArgumentsObject $argsObject = null)
    {
        $object = new LocalizedStringQueryObject("quote");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectReviewer()
    {
        $this->selectField("reviewer");

        return $this;
    }

    public function selectScore()
    {
        $this->selectField("score");

        return $this;
    }

    public function selectSite()
    {
        $this->selectField("site");

        return $this;
    }

    public function selectUrl()
    {
        $this->selectField("url");

        return $this;
    }
}
