<?php

namespace GraphQL\SchemaObject;

class ListFilterInputObject extends InputObject
{
    protected $classTypes;
    protected $listElementType;

    public function setClassTypes(array $classTypes)
    {
        $this->classTypes = $classTypes;

        return $this;
    }

    public function setListElementType($listElementType)
    {
        $this->listElementType = $listElementType;

        return $this;
    }
}
