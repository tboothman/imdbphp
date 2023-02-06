<?php

namespace GraphQL\SchemaObject;

class SoundtrackConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "SoundtrackConnection";

    public function selectEdges(SoundtrackConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new SoundtrackEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(SoundtrackConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectRestriction(SoundtrackConnectionRestrictionArgumentsObject $argsObject = null)
    {
        $object = new SoundtrackRestrictionQueryObject("restriction");
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
