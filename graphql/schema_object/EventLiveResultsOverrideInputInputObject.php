<?php

namespace GraphQL\SchemaObject;

class EventLiveResultsOverrideInputInputObject extends InputObject
{
    protected $enableOverride;
    protected $overrideEvent;

    public function setEnableOverride($enableOverride)
    {
        $this->enableOverride = $enableOverride;

        return $this;
    }

    public function setOverrideEvent(OverrideLiveEventInputInputObject $overrideLiveEventInputInputObject)
    {
        $this->overrideEvent = $overrideLiveEventInputInputObject;

        return $this;
    }
}
