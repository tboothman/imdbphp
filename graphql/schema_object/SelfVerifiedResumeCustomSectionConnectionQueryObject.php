<?php

namespace GraphQL\SchemaObject;

class SelfVerifiedResumeCustomSectionConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "SelfVerifiedResumeCustomSectionConnection";

    public function selectEdges(SelfVerifiedResumeCustomSectionConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new SelfVerifiedResumeCustomSectionEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(SelfVerifiedResumeCustomSectionConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
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
