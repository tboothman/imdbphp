<?php

namespace GraphQL\SchemaObject;

class CertificatesEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "CertificatesEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(CertificatesEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new CertificateQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPosition()
    {
        $this->selectField("position");

        return $this;
    }
}
