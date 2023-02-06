<?php

namespace GraphQL\SchemaObject;

class EventLiveResultsQueryObject extends QueryObject
{
    const OBJECT_NAME = "EventLiveResults";

    public function selectDisplayDescription(EventLiveResultsDisplayDescriptionArgumentsObject $argsObject = null)
    {
        $object = new LocalizedStringQueryObject("displayDescription");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectDisplayTitle(EventLiveResultsDisplayTitleArgumentsObject $argsObject = null)
    {
        $object = new LocalizedStringQueryObject("displayTitle");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectEventEditionAward(EventLiveResultsEventEditionAwardArgumentsObject $argsObject = null)
    {
        $object = new EventEditionAwardQueryObject("eventEditionAward");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectEventPageUrl()
    {
        $this->selectField("eventPageUrl");

        return $this;
    }

    public function selectNoWinnersBlurb(EventLiveResultsNoWinnersBlurbArgumentsObject $argsObject = null)
    {
        $object = new LocalizedStringQueryObject("noWinnersBlurb");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
