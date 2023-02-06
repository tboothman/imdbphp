<?php

namespace GraphQL\SchemaObject;

class CreditConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "CreditConnection";

    public function selectCompletenessStatus(CreditConnectionCompletenessStatusArgumentsObject $argsObject = null)
    {
        $object = new CreditsCompletenessStatusQueryObject("completenessStatus");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectEdges(CreditConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new CreditEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectOrderBy(CreditConnectionOrderByArgumentsObject $argsObject = null)
    {
        $object = new CreditsOrderedByQueryObject("orderBy");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(CreditConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectRestriction(CreditConnectionRestrictionArgumentsObject $argsObject = null)
    {
        $object = new CreditRestrictionQueryObject("restriction");
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
