<?php

namespace GraphQL\SchemaObject;

class ClaimedNameStatusEnumObject extends EnumObject
{
    const BLOCKED = "BLOCKED";
    const CLAIMED = "CLAIMED";
    const NOT_REQUESTED = "NOT_REQUESTED";
    const PENDING_APPROVAL = "PENDING_APPROVAL";
    const PENDING_CREATION = "PENDING_CREATION";
    const UNKNOWN = "UNKNOWN";
}
