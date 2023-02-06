<?php

namespace GraphQL\SchemaObject;

class ProductionAnnouncementQueryObject extends QueryObject
{
    const OBJECT_NAME = "ProductionAnnouncement";

    public function selectComment(ProductionAnnouncementCommentArgumentsObject $argsObject = null)
    {
        $object = new ProductionAnnouncementCommentQueryObject("comment");
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
}
