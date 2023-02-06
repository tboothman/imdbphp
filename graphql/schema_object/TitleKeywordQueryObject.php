<?php

namespace GraphQL\SchemaObject;

class TitleKeywordQueryObject extends QueryObject
{
    const OBJECT_NAME = "TitleKeyword";

    /**
     * @deprecated Use `keyword`
     */
    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectInterestScore(TitleKeywordInterestScoreArgumentsObject $argsObject = null)
    {
        $object = new InterestScoreQueryObject("interestScore");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectItemCategory(TitleKeywordItemCategoryArgumentsObject $argsObject = null)
    {
        $object = new TitleKeywordItemCategoryQueryObject("itemCategory");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectKeyword(TitleKeywordKeywordArgumentsObject $argsObject = null)
    {
        $object = new KeywordQueryObject("keyword");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    /**
     * @deprecated Use `keyword`
     */
    public function selectLanguage(TitleKeywordLanguageArgumentsObject $argsObject = null)
    {
        $object = new DisplayableLanguageQueryObject("language");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectLegacyId()
    {
        $this->selectField("legacyId");

        return $this;
    }

    /**
     * @deprecated Use `keyword`
     */
    public function selectText()
    {
        $this->selectField("text");

        return $this;
    }
}
