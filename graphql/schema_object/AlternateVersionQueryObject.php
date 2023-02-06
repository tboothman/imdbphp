<?php

namespace GraphQL\SchemaObject;

class AlternateVersionQueryObject extends QueryObject
{
    const OBJECT_NAME = "AlternateVersion";

    public function selectDisplayableArticle(AlternateVersionDisplayableArticleArgumentsObject $argsObject = null)
    {
        $object = new DisplayableArticleQueryObject("displayableArticle");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectText(AlternateVersionTextArgumentsObject $argsObject = null)
    {
        $object = new MarkdownQueryObject("text");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
