<?php

namespace GraphQL\SchemaObject;

class MetacriticQueryObject extends QueryObject
{
    const OBJECT_NAME = "Metacritic";

    public function selectMetascore(MetacriticMetascoreArgumentsObject $argsObject = null)
    {
        $object = new MetascoreQueryObject("metascore");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectReviews(MetacriticReviewsArgumentsObject $argsObject = null)
    {
        $object = new MetacriticReviewConnectionQueryObject("reviews");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectUrl()
    {
        $this->selectField("url");

        return $this;
    }
}
