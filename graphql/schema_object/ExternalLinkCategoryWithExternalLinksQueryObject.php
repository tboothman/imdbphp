<?php

namespace GraphQL\SchemaObject;

class ExternalLinkCategoryWithExternalLinksQueryObject extends QueryObject
{
    const OBJECT_NAME = "ExternalLinkCategoryWithExternalLinks";

    public function selectCategory(ExternalLinkCategoryWithExternalLinksCategoryArgumentsObject $argsObject = null)
    {
        $object = new ExternalLinkCategoryQueryObject("category");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectExternalLinks(ExternalLinkCategoryWithExternalLinksExternalLinksArgumentsObject $argsObject = null)
    {
        $object = new ExternalLinkConnectionQueryObject("externalLinks");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectRestriction(ExternalLinkCategoryWithExternalLinksRestrictionArgumentsObject $argsObject = null)
    {
        $object = new ExternalLinkRestrictionQueryObject("restriction");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
