<?php

namespace GraphQL\SchemaObject;

class TriviaCategoryWithTriviaQueryObject extends QueryObject
{
    const OBJECT_NAME = "TriviaCategoryWithTrivia";

    public function selectCategory(TriviaCategoryWithTriviaCategoryArgumentsObject $argsObject = null)
    {
        $object = new TriviaCategoryQueryObject("category");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectRestriction(TriviaCategoryWithTriviaRestrictionArgumentsObject $argsObject = null)
    {
        $object = new TriviaRestrictionQueryObject("restriction");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTrivia(TriviaCategoryWithTriviaTriviaArgumentsObject $argsObject = null)
    {
        $object = new TriviaConnectionQueryObject("trivia");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
