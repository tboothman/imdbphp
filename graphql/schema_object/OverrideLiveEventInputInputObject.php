<?php

namespace GraphQL\SchemaObject;

class OverrideLiveEventInputInputObject extends InputObject
{
    protected $awardId;
    protected $eventEditionId;

    public function setAwardId($awardId)
    {
        $this->awardId = $awardId;

        return $this;
    }

    public function setEventEditionId($eventEditionId)
    {
        $this->eventEditionId = $eventEditionId;

        return $this;
    }
}
