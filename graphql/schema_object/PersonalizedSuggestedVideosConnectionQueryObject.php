<?php

namespace GraphQL\SchemaObject;

class PersonalizedSuggestedVideosConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "PersonalizedSuggestedVideosConnection";

    public function selectEdges(PersonalizedSuggestedVideosConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new PersonalizedSuggestedVideosEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(PersonalizedSuggestedVideosConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
