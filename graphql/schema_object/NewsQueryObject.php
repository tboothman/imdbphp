<?php

namespace GraphQL\SchemaObject;

class NewsQueryObject extends QueryObject
{
    const OBJECT_NAME = "News";

    public function selectArticleTitle(NewsArticleTitleArgumentsObject $argsObject = null)
    {
        $object = new MarkdownQueryObject("articleTitle");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectByline()
    {
        $this->selectField("byline");

        return $this;
    }

    public function selectDate()
    {
        $this->selectField("date");

        return $this;
    }

    public function selectExternalUrl()
    {
        $this->selectField("externalUrl");

        return $this;
    }

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectImage(NewsImageArgumentsObject $argsObject = null)
    {
        $object = new ImageQueryObject("image");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectLanguage(NewsLanguageArgumentsObject $argsObject = null)
    {
        $object = new DisplayableLanguageQueryObject("language");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectSource(NewsSourceArgumentsObject $argsObject = null)
    {
        $object = new NewsSourceQueryObject("source");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectText(NewsTextArgumentsObject $argsObject = null)
    {
        $object = new MarkdownQueryObject("text");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
