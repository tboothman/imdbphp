<?php

namespace GraphQL\SchemaObject;

class RootEventLiveResultsArgumentsObject extends ArgumentsObject
{
    protected $override;

    public function setOverride(EventLiveResultsOverrideInputInputObject $eventLiveResultsOverrideInputInputObject)
    {
        $this->override = $eventLiveResultsOverrideInputInputObject;

        return $this;
    }
}
