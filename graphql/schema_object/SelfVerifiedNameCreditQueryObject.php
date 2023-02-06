<?php

namespace GraphQL\SchemaObject;

class SelfVerifiedNameCreditQueryObject extends QueryObject
{
    const OBJECT_NAME = "SelfVerifiedNameCredit";

    public function selectCompanyOrDirector(SelfVerifiedNameCreditCompanyOrDirectorArgumentsObject $argsObject = null)
    {
        $object = new SelfVerifiedNameAttributeValueQueryObject("companyOrDirector");
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

    public function selectProjectTitle(SelfVerifiedNameCreditProjectTitleArgumentsObject $argsObject = null)
    {
        $object = new SelfVerifiedNameAttributeValueQueryObject("projectTitle");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectRoleOrPosition(SelfVerifiedNameCreditRoleOrPositionArgumentsObject $argsObject = null)
    {
        $object = new SelfVerifiedNameAttributeValueQueryObject("roleOrPosition");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectType(SelfVerifiedNameCreditTypeArgumentsObject $argsObject = null)
    {
        $object = new SelfVerifiedNameCreditTypeQueryObject("type");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
