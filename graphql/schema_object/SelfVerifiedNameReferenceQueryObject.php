<?php

namespace GraphQL\SchemaObject;

class SelfVerifiedNameReferenceQueryObject extends QueryObject
{
    const OBJECT_NAME = "SelfVerifiedNameReference";

    public function selectContactInfo(SelfVerifiedNameReferenceContactInfoArgumentsObject $argsObject = null)
    {
        $object = new SelfVerifiedNameAttributeValueQueryObject("contactInfo");
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

    public function selectName(SelfVerifiedNameReferenceNameArgumentsObject $argsObject = null)
    {
        $object = new SelfVerifiedNameAttributeValueQueryObject("name");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectRelationship(SelfVerifiedNameReferenceRelationshipArgumentsObject $argsObject = null)
    {
        $object = new SelfVerifiedNameAttributeValueQueryObject("relationship");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
