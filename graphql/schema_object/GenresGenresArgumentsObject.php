<?php

namespace GraphQL\SchemaObject;

class GenresGenresArgumentsObject extends ArgumentsObject
{
    protected $limit;
    protected $sort;

    public function setLimit($limit)
    {
        $this->limit = $limit;

        return $this;
    }

    public function setSort(GenreSortInputObject $genreSortInputObject)
    {
        $this->sort = $genreSortInputObject;

        return $this;
    }
}
