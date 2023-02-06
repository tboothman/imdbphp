<?php

namespace GraphQL\SchemaObject;

class SelfVerifiedNameCreditMetadataQueryObject extends QueryObject
{
    const OBJECT_NAME = "SelfVerifiedNameCreditMetadata";

    public function selectCreditTypes(SelfVerifiedNameCreditMetadataCreditTypesArgumentsObject $argsObject = null)
    {
        $object = new SelfVerifiedNameCreditTypeQueryObject("creditTypes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectLimit()
    {
        $this->selectField("limit");

        return $this;
    }
}
