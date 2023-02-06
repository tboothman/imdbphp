<?php

namespace GraphQL\SchemaObject;

class NameCreditConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "NameCreditConnection";

    public function selectEdges(NameCreditConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new CreditEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectOrderBy(NameCreditConnectionOrderByArgumentsObject $argsObject = null)
    {
        $object = new CreditsOrderedByQueryObject("orderBy");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(NameCreditConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectRestriction(NameCreditConnectionRestrictionArgumentsObject $argsObject = null)
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
