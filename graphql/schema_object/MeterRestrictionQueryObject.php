<?php

namespace GraphQL\SchemaObject;

class MeterRestrictionQueryObject extends QueryObject
{
    const OBJECT_NAME = "MeterRestriction";

    public function selectExplanations(MeterRestrictionExplanationsArgumentsObject $argsObject = null)
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
}
