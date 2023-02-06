<?php

namespace GraphQL\SchemaObject;

class RecommendationExplanationQueryObject extends QueryObject
{
    const OBJECT_NAME = "RecommendationExplanation";

    public function selectTitle(RecommendationExplanationTitleArgumentsObject $argsObject = null)
    {
        $object = new TitleQueryObject("title");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
