<?php

namespace GraphQL\SchemaObject;

class ParentsGuideQueryObject extends QueryObject
{
    const OBJECT_NAME = "ParentsGuide";

    public function selectCategories(ParentsGuideCategoriesArgumentsObject $argsObject = null)
    {
        $object = new ParentsGuideCategorySummaryQueryObject("categories");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectGuideItems(ParentsGuideGuideItemsArgumentsObject $argsObject = null)
    {
        $object = new ParentsGuideConnectionQueryObject("guideItems");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
