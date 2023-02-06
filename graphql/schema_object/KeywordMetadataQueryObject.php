<?php

namespace GraphQL\SchemaObject;

class KeywordMetadataQueryObject extends QueryObject
{
    const OBJECT_NAME = "KeywordMetadata";

    public function selectKeywordCategories(KeywordMetadataKeywordCategoriesArgumentsObject $argsObject = null)
    {
        $object = new KeywordCategoryQueryObject("keywordCategories");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
