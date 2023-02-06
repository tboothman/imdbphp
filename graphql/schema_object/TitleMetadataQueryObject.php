<?php

namespace GraphQL\SchemaObject;

class TitleMetadataQueryObject extends QueryObject
{
    const OBJECT_NAME = "TitleMetadata";

    public function selectExternalLinkCategories(TitleMetadataExternalLinkCategoriesArgumentsObject $argsObject = null)
    {
        $object = new ExternalLinkCategoryQueryObject("externalLinkCategories");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectGoofCategories(TitleMetadataGoofCategoriesArgumentsObject $argsObject = null)
    {
        $object = new GoofCategoryQueryObject("goofCategories");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTitleConnectionCategories(TitleMetadataTitleConnectionCategoriesArgumentsObject $argsObject = null)
    {
        $object = new TitleConnectionCategoryQueryObject("titleConnectionCategories");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTitleGenres(TitleMetadataTitleGenresArgumentsObject $argsObject = null)
    {
        $object = new GenreItemQueryObject("titleGenres");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTitleTypeCategories(TitleMetadataTitleTypeCategoriesArgumentsObject $argsObject = null)
    {
        $object = new TitleTypeCategoryWithTitleTypesQueryObject("titleTypeCategories");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTitleTypes(TitleMetadataTitleTypesArgumentsObject $argsObject = null)
    {
        $object = new TitleTypeQueryObject("titleTypes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
