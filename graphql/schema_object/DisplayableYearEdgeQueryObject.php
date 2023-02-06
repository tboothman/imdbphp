<?php

namespace GraphQL\SchemaObject;

class DisplayableYearEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "DisplayableYearEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(DisplayableYearEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new LocalizedDisplayableEpisodeYearQueryObject("node");
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
