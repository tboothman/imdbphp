<?php

namespace GraphQL\SchemaObject;

class DisplayableArticleQueryObject extends QueryObject
{
    const OBJECT_NAME = "DisplayableArticle";

    public function selectBody(DisplayableArticleBodyArgumentsObject $argsObject = null)
    {
        $object = new MarkdownQueryObject("body");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectFooter(DisplayableArticleFooterArgumentsObject $argsObject = null)
    {
        $object = new MarkdownQueryObject("footer");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectHeader(DisplayableArticleHeaderArgumentsObject $argsObject = null)
    {
        $object = new MarkdownQueryObject("header");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
