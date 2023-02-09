<?php

namespace GraphQL\SchemaObject;

class NameKnownForRestrictionQueryObject extends QueryObject
{
    const OBJECT_NAME = "NameKnownForRestriction";

    public function selectExplanations(NameKnownForRestrictionExplanationsArgumentsObject $argsObject = null)
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