<?php

namespace GraphQL\SchemaObject;

class ListPrimaryImageQueryObject extends QueryObject
{
    const OBJECT_NAME = "ListPrimaryImage";

    public function selectImage(ListPrimaryImageImageArgumentsObject $argsObject = null)
    {
        $object = new ImageQueryObject("image");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
