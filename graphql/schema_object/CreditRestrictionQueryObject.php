<?php

namespace GraphQL\SchemaObject;

class CreditRestrictionQueryObject extends QueryObject
{
    const OBJECT_NAME = "CreditRestriction";

    public function selectExplanations(CreditRestrictionExplanationsArgumentsObject $argsObject = null)
    {
        $object = new RestrictionExplanationQueryObject("explanations");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectReasons()
    {
        $this->selectField("reasons");

        return $this;
    }

    public function selectRestrictionReason()
    {
        $this->selectField("restrictionReason");

        return $this;
    }

    public function selectUnrestrictedTotal()
    {
        $this->selectField("unrestrictedTotal");

        return $this;
    }
}
