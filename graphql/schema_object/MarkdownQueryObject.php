<?php

namespace GraphQL\SchemaObject;

class MarkdownQueryObject extends QueryObject
{
    const OBJECT_NAME = "Markdown";

    public function selectMarkdown()
    {
        $this->selectField("markdown");

        return $this;
    }

    public function selectPlaidHtml()
    {
        $this->selectField("plaidHtml");

        return $this;
    }

    public function selectPlainText()
    {
        $this->selectField("plainText");

        return $this;
    }
}
