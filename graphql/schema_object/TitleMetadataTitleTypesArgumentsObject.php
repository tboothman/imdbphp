<?php

namespace GraphQL\SchemaObject;

use GraphQL\RawObject;

class TitleMetadataTitleTypesArgumentsObject extends ArgumentsObject
{
    protected $category;

    public function setCategory($titleTypeCategoryValue)
    {
        $this->category = new RawObject($titleTypeCategoryValue);

        return $this;
    }
}
