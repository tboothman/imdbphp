<?php

namespace GraphQL\SchemaObject;

class ProductionStatusHistoryQueryObject extends QueryObject
{
    const OBJECT_NAME = "ProductionStatusHistory";

    public function selectComment(ProductionStatusHistoryCommentArgumentsObject $argsObject = null)
    {
        $object = new ProductionStatusHistoryCommentQueryObject("comment");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectDate()
    {
        $this->selectField("date");

        return $this;
    }

    public function selectStage(ProductionStatusHistoryStageArgumentsObject $argsObject = null)
    {
        $object = new ProductionStageQueryObject("stage");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectStatus(ProductionStatusHistoryStatusArgumentsObject $argsObject = null)
    {
        $object = new ProductionStatusQueryObject("status");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
