<?php

namespace GraphQL\SchemaObject;

class CompanyKnownForTitleConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "CompanyKnownForTitleConnection";

    public function selectEdges(CompanyKnownForTitleConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new CompanyKnownForTitleEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(CompanyKnownForTitleConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectRecordPoolSize()
    {
        $this->selectField("recordPoolSize");

        return $this;
    }

    public function selectTotal()
    {
        $this->selectField("total");

        return $this;
    }
}
