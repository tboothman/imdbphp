<?php

namespace GraphQL\SchemaObject;

class NameRelationQueryObject extends QueryObject
{
    const OBJECT_NAME = "NameRelation";

    public function selectBirthDate(NameRelationBirthDateArgumentsObject $argsObject = null)
    {
        $object = new DisplayableDateQueryObject("birthDate");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectGenderIdentity(NameRelationGenderIdentityArgumentsObject $argsObject = null)
    {
        $object = new GenderIdentityQueryObject("genderIdentity");
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

    public function selectRelationName(NameRelationRelationNameArgumentsObject $argsObject = null)
    {
        $object = new RelationNameQueryObject("relationName");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectRelationshipType(NameRelationRelationshipTypeArgumentsObject $argsObject = null)
    {
        $object = new NameRelationTypeQueryObject("relationshipType");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
