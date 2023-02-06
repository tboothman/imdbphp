<?php

namespace GraphQL\SchemaObject;

class ProductionBudgetQueryObject extends QueryObject
{
    const OBJECT_NAME = "ProductionBudget";

    public function selectBudget(ProductionBudgetBudgetArgumentsObject $argsObject = null)
    {
        $object = new MoneyQueryObject("budget");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
