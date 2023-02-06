<?php

namespace GraphQL\SchemaObject;

class CreditCategorySummaryQueryObject extends QueryObject
{
    const OBJECT_NAME = "CreditCategorySummary";

    public function selectCategory(CreditCategorySummaryCategoryArgumentsObject $argsObject = null)
    {
        $object = new CreditCategoryQueryObject("category");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTotal()
    {
        $this->selectField("total");

        return $this;
    }
}
