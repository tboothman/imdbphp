<?php

namespace GraphQL\SchemaObject;

class TitleKeywordItemCategoryWithKeywordsQueryObject extends QueryObject
{
    const OBJECT_NAME = "TitleKeywordItemCategoryWithKeywords";

    public function selectItemCategory(TitleKeywordItemCategoryWithKeywordsItemCategoryArgumentsObject $argsObject = null)
    {
        $object = new TitleKeywordItemCategoryQueryObject("itemCategory");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectKeywords(TitleKeywordItemCategoryWithKeywordsKeywordsArgumentsObject $argsObject = null)
    {
        $object = new TitleKeywordConnectionQueryObject("keywords");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
