<?php

namespace GraphQL\SchemaObject;

class TrademarkQueryObject extends QueryObject
{
    const OBJECT_NAME = "Trademark";

    public function selectDisplayableArticle(TrademarkDisplayableArticleArgumentsObject $argsObject = null)
    {
        $object = new DisplayableArticleQueryObject("displayableArticle");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectText(TrademarkTextArgumentsObject $argsObject = null)
    {
        $object = new MarkdownQueryObject("text");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
