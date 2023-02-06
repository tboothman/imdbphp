<?php

namespace GraphQL\SchemaObject;

class SelfVerifiedNameTrainingQueryObject extends QueryObject
{
    const OBJECT_NAME = "SelfVerifiedNameTraining";

    public function selectDetails(SelfVerifiedNameTrainingDetailsArgumentsObject $argsObject = null)
    {
        $object = new SelfVerifiedNameAttributeValueQueryObject("details");
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

    public function selectInstructor(SelfVerifiedNameTrainingInstructorArgumentsObject $argsObject = null)
    {
        $object = new SelfVerifiedNameAttributeValueQueryObject("instructor");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectLocation(SelfVerifiedNameTrainingLocationArgumentsObject $argsObject = null)
    {
        $object = new SelfVerifiedNameAttributeValueQueryObject("location");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectSchool(SelfVerifiedNameTrainingSchoolArgumentsObject $argsObject = null)
    {
        $object = new SelfVerifiedNameAttributeValueQueryObject("school");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectType(SelfVerifiedNameTrainingTypeArgumentsObject $argsObject = null)
    {
        $object = new SelfVerifiedNameAttributeValueQueryObject("type");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectYear()
    {
        $this->selectField("year");

        return $this;
    }
}
