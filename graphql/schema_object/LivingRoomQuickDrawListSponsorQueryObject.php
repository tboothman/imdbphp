<?php

namespace GraphQL\SchemaObject;

class LivingRoomQuickDrawListSponsorQueryObject extends QueryObject
{
    const OBJECT_NAME = "LivingRoomQuickDrawListSponsor";

    public function selectHeading(LivingRoomQuickDrawListSponsorHeadingArgumentsObject $argsObject = null)
    {
        $object = new LocalizedStringQueryObject("heading");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectLogo(LivingRoomQuickDrawListSponsorLogoArgumentsObject $argsObject = null)
    {
        $object = new MediaServiceImageQueryObject("logo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPromotion(LivingRoomQuickDrawListSponsorPromotionArgumentsObject $argsObject = null)
    {
        $object = new MediaServiceImageQueryObject("promotion");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPromotionalHeading(LivingRoomQuickDrawListSponsorPromotionalHeadingArgumentsObject $argsObject = null)
    {
        $object = new LocalizedStringQueryObject("promotionalHeading");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectSponsoredBy(LivingRoomQuickDrawListSponsorSponsoredByArgumentsObject $argsObject = null)
    {
        $object = new LocalizedStringQueryObject("sponsoredBy");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectSubheading(LivingRoomQuickDrawListSponsorSubheadingArgumentsObject $argsObject = null)
    {
        $object = new LocalizedStringQueryObject("subheading");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
