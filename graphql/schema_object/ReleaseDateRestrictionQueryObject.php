<?php

namespace GraphQL\SchemaObject;

class ReleaseDateRestrictionQueryObject extends QueryObject
{
    const OBJECT_NAME = "ReleaseDateRestriction";

    public function selectExplanations(ReleaseDateRestrictionExplanationsArgumentsObject $argsObject = null)
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
