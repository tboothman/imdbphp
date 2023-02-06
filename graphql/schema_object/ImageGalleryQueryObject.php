<?php

namespace GraphQL\SchemaObject;

class ImageGalleryQueryObject extends QueryObject
{
    const OBJECT_NAME = "ImageGallery";

    public function selectGalleryText()
    {
        $this->selectField("galleryText");

        return $this;
    }

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectImages(ImageGalleryImagesArgumentsObject $argsObject = null)
    {
        $object = new ImageConnectionQueryObject("images");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
