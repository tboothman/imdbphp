<?php

namespace GraphQL\SchemaObject;

class SharedCreditCategorySummaryQueryObject extends QueryObject
{
    const OBJECT_NAME = "SharedCreditCategorySummary";

    public function selectCount()
    {
        $this->selectField("count");

        return $this;
    }

    public function selectCreditCategory(SharedCreditCategorySummaryCreditCategoryArgumentsObject $argsObject = null)
    {
        $object = new CreditCategoryQueryObject("creditCategory");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
