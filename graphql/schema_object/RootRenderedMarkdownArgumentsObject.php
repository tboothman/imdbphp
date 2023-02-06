<?php

namespace GraphQL\SchemaObject;

class RootRenderedMarkdownArgumentsObject extends ArgumentsObject
{
    protected $markdownString;

    public function setMarkdownString($markdownString)
    {
        $this->markdownString = $markdownString;

        return $this;
    }
}
