<?php

namespace GraphQL\SchemaObject;

class SearchMetadataQueryObject extends QueryObject
{
    const OBJECT_NAME = "SearchMetadata";

    public function selectAdvancedSearchAwardOptions(SearchMetadataAdvancedSearchAwardOptionsArgumentsObject $argsObject = null)
    {
        $object = new SearchAwardEventOptionsQueryObject("advancedSearchAwardOptions");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
