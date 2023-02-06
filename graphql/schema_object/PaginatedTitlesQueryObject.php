<?php

namespace GraphQL\SchemaObject;

class PaginatedTitlesQueryObject extends QueryObject
{
    const OBJECT_NAME = "PaginatedTitles";

    public function selectPaginationToken()
    {
        $this->selectField("paginationToken");

        return $this;
    }

    public function selectTitles(PaginatedTitlesTitlesArgumentsObject $argsObject = null)
    {
        $object = new TitleQueryObject("titles");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
