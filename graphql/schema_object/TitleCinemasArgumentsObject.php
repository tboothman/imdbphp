<?php

namespace GraphQL\SchemaObject;

class TitleCinemasArgumentsObject extends ArgumentsObject
{
    protected $first;
    protected $request;

    public function setFirst($first)
    {
        $this->first = $first;

        return $this;
    }

    public function setRequest(TitleCinemasRequestInputObject $titleCinemasRequestInputObject)
    {
        $this->request = $titleCinemasRequestInputObject;

        return $this;
    }
}
