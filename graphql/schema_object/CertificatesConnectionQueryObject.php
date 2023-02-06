<?php

namespace GraphQL\SchemaObject;

class CertificatesConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "CertificatesConnection";

    public function selectEdges(CertificatesConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new CertificatesEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(CertificatesConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTotal()
    {
        $this->selectField("total");

        return $this;
    }
}
