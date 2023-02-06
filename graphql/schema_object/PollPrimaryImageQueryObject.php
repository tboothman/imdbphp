<?php

namespace GraphQL\SchemaObject;

class PollPrimaryImageQueryObject extends QueryObject
{
    const OBJECT_NAME = "PollPrimaryImage";

    public function selectImage(PollPrimaryImageImageArgumentsObject $argsObject = null)
    {
        $object = new ImageQueryObject("image");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
