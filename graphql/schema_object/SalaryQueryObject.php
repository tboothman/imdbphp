<?php

namespace GraphQL\SchemaObject;

class SalaryQueryObject extends QueryObject
{
    const OBJECT_NAME = "Salary";

    public function selectAmount(SalaryAmountArgumentsObject $argsObject = null)
    {
        $object = new MoneyQueryObject("amount");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectAttributes(SalaryAttributesArgumentsObject $argsObject = null)
    {
        $object = new DisplayableAttributeQueryObject("attributes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectDisplayableProperty(SalaryDisplayablePropertyArgumentsObject $argsObject = null)
    {
        $object = new DisplayableSalaryPropertyQueryObject("displayableProperty");
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

    public function selectTitle(SalaryTitleArgumentsObject $argsObject = null)
    {
        $object = new TitleQueryObject("title");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
