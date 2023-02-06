<?php

namespace GraphQL\SchemaObject;

class NameBioQueryObject extends QueryObject
{
    const OBJECT_NAME = "NameBio";

    public function selectDisplayableArticle(NameBioDisplayableArticleArgumentsObject $argsObject = null)
    {
        $object = new DisplayableArticleQueryObject("displayableArticle");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectLanguage(NameBioLanguageArgumentsObject $argsObject = null)
    {
        $object = new DisplayableLanguageQueryObject("language");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectText(NameBioTextArgumentsObject $argsObject = null)
    {
        $object = new MarkdownQueryObject("text");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
