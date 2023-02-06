<?php

namespace GraphQL\SchemaObject;

class ReviewTextQueryObject extends QueryObject
{
    const OBJECT_NAME = "ReviewText";

    public function selectOriginalText(ReviewTextOriginalTextArgumentsObject $argsObject = null)
    {
        $object = new MarkdownQueryObject("originalText");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
