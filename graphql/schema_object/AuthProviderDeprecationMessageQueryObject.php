<?php

namespace GraphQL\SchemaObject;

class AuthProviderDeprecationMessageQueryObject extends QueryObject
{
    const OBJECT_NAME = "AuthProviderDeprecationMessage";

    public function selectMessage(AuthProviderDeprecationMessageMessageArgumentsObject $argsObject = null)
    {
        $object = new LocalizedMarkdownQueryObject("message");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectUrls(AuthProviderDeprecationMessageUrlsArgumentsObject $argsObject = null)
    {
        $object = new AuthProviderDeprecationUrlQueryObject("urls");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
