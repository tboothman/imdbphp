<?php

namespace GraphQL\SchemaObject;

class SelfVerifiedResumeCustomSectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "SelfVerifiedResumeCustomSection";

    public function selectBody(SelfVerifiedResumeCustomSectionBodyArgumentsObject $argsObject = null)
    {
        $object = new SelfVerifiedNameAttributeValueQueryObject("body");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectTitle(SelfVerifiedResumeCustomSectionTitleArgumentsObject $argsObject = null)
    {
        $object = new SelfVerifiedNameAttributeValueQueryObject("title");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
