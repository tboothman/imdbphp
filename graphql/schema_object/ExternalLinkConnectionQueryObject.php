<?php

namespace GraphQL\SchemaObject;

class ExternalLinkConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "ExternalLinkConnection";

    public function selectEdges(ExternalLinkConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new ExternalLinkEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(ExternalLinkConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectRestriction(ExternalLinkConnectionRestrictionArgumentsObject $argsObject = null)
    {
        $object = new ExternalLinkRestrictionQueryObject("restriction");
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
