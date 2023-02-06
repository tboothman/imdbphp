<?php

namespace GraphQL\SchemaObject;

class UserQueryObject extends QueryObject
{
    const OBJECT_NAME = "User";

    public function selectCreationDate()
    {
        $this->selectField("creationDate");

        return $this;
    }

    public function selectDisplayName()
    {
        $this->selectField("displayName");

        return $this;
    }

    public function selectFeedbackGiven(UserFeedbackGivenArgumentsObject $argsObject = null)
    {
        $object = new FeedbackGivenQueryObject("feedbackGiven");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectLinkedAuthProviders(UserLinkedAuthProvidersArgumentsObject $argsObject = null)
    {
        $object = new LinkedAuthProviderQueryObject("linkedAuthProviders");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPreferredLanguage()
    {
        $this->selectField("preferredLanguage");

        return $this;
    }

    public function selectProStatus(UserProStatusArgumentsObject $argsObject = null)
    {
        $object = new ProStatusQueryObject("proStatus");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectProfile(UserProfileArgumentsObject $argsObject = null)
    {
        $object = new UserProfileQueryObject("profile");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectStaffStatus(UserStaffStatusArgumentsObject $argsObject = null)
    {
        $object = new StaffStatusQueryObject("staffStatus");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
