<?php

namespace GraphQL\SchemaObject;

class LivingRoomGameAssetsQueryObject extends QueryObject
{
    const OBJECT_NAME = "LivingRoomGameAssets";

    public function selectBackgroundImage(LivingRoomGameAssetsBackgroundImageArgumentsObject $argsObject = null)
    {
        $object = new AnimatedImageQueryObject("backgroundImage");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPreviewBackgroundImage(LivingRoomGameAssetsPreviewBackgroundImageArgumentsObject $argsObject = null)
    {
        $object = new AnimatedImageQueryObject("previewBackgroundImage");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPreviewTitleBackground(LivingRoomGameAssetsPreviewTitleBackgroundArgumentsObject $argsObject = null)
    {
        $object = new MediaServiceImageQueryObject("previewTitleBackground");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTitleBackground(LivingRoomGameAssetsTitleBackgroundArgumentsObject $argsObject = null)
    {
        $object = new MediaServiceImageQueryObject("titleBackground");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTitleLogo(LivingRoomGameAssetsTitleLogoArgumentsObject $argsObject = null)
    {
        $object = new MediaServiceImageQueryObject("titleLogo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
