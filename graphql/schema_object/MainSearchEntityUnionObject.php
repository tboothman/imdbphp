<?php

namespace GraphQL\SchemaObject;

class MainSearchEntityUnionObject extends UnionObject
{
    public function onCompany()
    {
        $object = new CompanyQueryObject();
        $this->addPossibleType($object);

        return $object;
    }

    public function onKeyword()
    {
        $object = new KeywordQueryObject();
        $this->addPossibleType($object);

        return $object;
    }

    public function onName()
    {
        $object = new NameQueryObject();
        $this->addPossibleType($object);

        return $object;
    }

    public function onTitle()
    {
        $object = new TitleQueryObject();
        $this->addPossibleType($object);

        return $object;
    }
}
