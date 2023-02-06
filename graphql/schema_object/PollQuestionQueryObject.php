<?php

namespace GraphQL\SchemaObject;

class PollQuestionQueryObject extends QueryObject
{
    const OBJECT_NAME = "PollQuestion";

    public function selectOriginalText(PollQuestionOriginalTextArgumentsObject $argsObject = null)
    {
        $object = new MarkdownQueryObject("originalText");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
