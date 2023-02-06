<?php

namespace GraphQL\SchemaObject;

class CompanyKnownForClientConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "CompanyKnownForClientConnection";

    public function selectEdges(CompanyKnownForClientConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new CompanyKnownForClientEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(CompanyKnownForClientConnectionPageInfoArgumentsObject $argsObject = null)
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
