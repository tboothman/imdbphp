<?php

namespace GraphQL\SchemaObject;

class TitleRecommendationQueryObject extends QueryObject
{
    const OBJECT_NAME = "TitleRecommendation";

    public function selectExplanations(TitleRecommendationExplanationsArgumentsObject $argsObject = null)
    {
        $object = new RecommendationExplanationQueryObject("explanations");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectRefTag()
    {
        $this->selectField("refTag");

        return $this;
    }

    public function selectTitle(TitleRecommendationTitleArgumentsObject $argsObject = null)
    {
        $object = new TitleQueryObject("title");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
