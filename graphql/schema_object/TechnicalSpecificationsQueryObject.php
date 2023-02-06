<?php

namespace GraphQL\SchemaObject;

class TechnicalSpecificationsQueryObject extends QueryObject
{
    const OBJECT_NAME = "TechnicalSpecifications";

    public function selectAspectRatios(TechnicalSpecificationsAspectRatiosArgumentsObject $argsObject = null)
    {
        $object = new AspectRatiosQueryObject("aspectRatios");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectCameras(TechnicalSpecificationsCamerasArgumentsObject $argsObject = null)
    {
        $object = new CamerasQueryObject("cameras");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectColorations(TechnicalSpecificationsColorationsArgumentsObject $argsObject = null)
    {
        $object = new ColorationsQueryObject("colorations");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectFilmLengths(TechnicalSpecificationsFilmLengthsArgumentsObject $argsObject = null)
    {
        $object = new FilmLengthsQueryObject("filmLengths");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectLaboratories(TechnicalSpecificationsLaboratoriesArgumentsObject $argsObject = null)
    {
        $object = new LaboratoriesQueryObject("laboratories");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNegativeFormats(TechnicalSpecificationsNegativeFormatsArgumentsObject $argsObject = null)
    {
        $object = new NegativeFormatsQueryObject("negativeFormats");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPrintedFormats(TechnicalSpecificationsPrintedFormatsArgumentsObject $argsObject = null)
    {
        $object = new PrintedFormatsQueryObject("printedFormats");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectProcesses(TechnicalSpecificationsProcessesArgumentsObject $argsObject = null)
    {
        $object = new ProcessesQueryObject("processes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectSoundMixes(TechnicalSpecificationsSoundMixesArgumentsObject $argsObject = null)
    {
        $object = new SoundMixesQueryObject("soundMixes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
