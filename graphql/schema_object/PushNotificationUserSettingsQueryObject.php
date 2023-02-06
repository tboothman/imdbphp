<?php

namespace GraphQL\SchemaObject;

class PushNotificationUserSettingsQueryObject extends QueryObject
{
    const OBJECT_NAME = "PushNotificationUserSettings";

    public function selectPushNotificationUserId()
    {
        $this->selectField("pushNotificationUserId");

        return $this;
    }
}
