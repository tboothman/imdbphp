<?php

namespace GraphQL\SchemaObject;

class DemographicQueryObject extends QueryObject
{
    const OBJECT_NAME = "Demographic";

    public function selectAge()
    {
        $this->selectField("age");

        return $this;
    }

    public function selectCountry()
    {
        $this->selectField("country");

        return $this;
    }

    public function selectDisplayText(DemographicDisplayTextArgumentsObject $argsObject = null)
    {
        $object = new LocalizedStringQueryObject("displayText");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectGender()
    {
        $this->selectField("gender");

        return $this;
    }

    public function selectUserCategory()
    {
        $this->selectField("userCategory");

        return $this;
    }
}
