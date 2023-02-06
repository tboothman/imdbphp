<?php

namespace GraphQL\SchemaObject;

class ListItemUnionObject extends UnionObject
{
    public function onImage()
    {
        $object = new ImageQueryObject();
        $this->addPossibleType($object);

        return $object;
    }

    public function onName()
    {
        $object = new NameQueryObject();
        $this->addPossibleType($object);

        return $object;
    }

    public function onTitle()
    {
        $object = new TitleQueryObject();
        $this->addPossibleType($object);

        return $object;
    }

    public function onVideo()
    {
        $object = new VideoQueryObject();
        $this->addPossibleType($object);

        return $object;
    }
}
