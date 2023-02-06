<?php

namespace GraphQL\SchemaObject;

class TestQueryObject extends QueryObject
{
    const OBJECT_NAME = "Test";

    public function selectError()
    {
        $this->selectField("error");

        return $this;
    }

    public function selectExperimental()
    {
        $this->selectField("experimental");

        return $this;
    }

    public function selectResult()
    {
        $this->selectField("result");

        return $this;
    }

    public function selectTestItems(TestTestItemsArgumentsObject $argsObject = null)
    {
        $object = new TestItemQueryObject("testItems");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
