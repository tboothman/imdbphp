<?php

namespace GraphQL\SchemaObject;

class ProductionStatusDetailsQueryObject extends QueryObject
{
    const OBJECT_NAME = "ProductionStatusDetails";

    public function selectAnnouncements(ProductionStatusDetailsAnnouncementsArgumentsObject $argsObject = null)
    {
        $object = new ProductionAnnouncementQueryObject("announcements");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectCurrentProductionStage(ProductionStatusDetailsCurrentProductionStageArgumentsObject $argsObject = null)
    {
        $object = new ProductionStageQueryObject("currentProductionStage");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectProductionStatusHistory(ProductionStatusDetailsProductionStatusHistoryArgumentsObject $argsObject = null)
    {
        $object = new ProductionStatusHistoryQueryObject("productionStatusHistory");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectRestriction(ProductionStatusDetailsRestrictionArgumentsObject $argsObject = null)
    {
        $object = new ProductionStatusHistoryRestrictionQueryObject("restriction");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
