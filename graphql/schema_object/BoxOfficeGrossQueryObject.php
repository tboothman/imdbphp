<?php

namespace GraphQL\SchemaObject;

class BoxOfficeGrossQueryObject extends QueryObject
{
    const OBJECT_NAME = "BoxOfficeGross";

    public function selectTotal(BoxOfficeGrossTotalArgumentsObject $argsObject = null)
    {
        $object = new MoneyQueryObject("total");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
