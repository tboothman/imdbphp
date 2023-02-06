<?php

namespace GraphQL\SchemaObject;

class ImageConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "ImageConnection";

    public function selectEdges(ImageConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new ImageEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectIsPaginationDirty()
    {
        $this->selectField("isPaginationDirty");

        return $this;
    }

    public function selectPageInfo(ImageConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectRestriction(ImageConnectionRestrictionArgumentsObject $argsObject = null)
    {
        $object = new ImageRestrictionQueryObject("restriction");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTotal()
    {
        $this->selectField("total");

        return $this;
    }
}
