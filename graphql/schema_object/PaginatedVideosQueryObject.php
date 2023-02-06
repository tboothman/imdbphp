<?php

namespace GraphQL\SchemaObject;

class PaginatedVideosQueryObject extends QueryObject
{
    const OBJECT_NAME = "PaginatedVideos";

    public function selectPaginationToken()
    {
        $this->selectField("paginationToken");

        return $this;
    }

    public function selectVideos(PaginatedVideosVideosArgumentsObject $argsObject = null)
    {
        $object = new VideoQueryObject("videos");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
