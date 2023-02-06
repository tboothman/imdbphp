<?php

namespace GraphQL\SchemaObject;

class SelfVerifiedNameCreditTypeWithCreditsQueryObject extends QueryObject
{
    const OBJECT_NAME = "SelfVerifiedNameCreditTypeWithCredits";

    public function selectCreditType(SelfVerifiedNameCreditTypeWithCreditsCreditTypeArgumentsObject $argsObject = null)
    {
        $object = new SelfVerifiedNameCreditTypeQueryObject("creditType");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectCredits(SelfVerifiedNameCreditTypeWithCreditsCreditsArgumentsObject $argsObject = null)
    {
        $object = new SelfVerifiedNameCreditConnectionQueryObject("credits");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
