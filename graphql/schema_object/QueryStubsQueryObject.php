<?php

namespace GraphQL\SchemaObject;

class QueryStubsQueryObject extends QueryObject
{
    const OBJECT_NAME = "QueryStubs";

    public function selectMatrix(QueryStubsMatrixArgumentsObject $argsObject = null)
    {
        $object = new TitleQueryObject("matrix");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
