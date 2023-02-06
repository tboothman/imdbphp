<?php

namespace GraphQL\SchemaObject;

class CreditedOrUncreditedFilterEnumObject extends EnumObject
{
    const ALL_CREDITS = "ALL_CREDITS";
    const CREDITED_ONLY = "CREDITED_ONLY";
    const UNCREDITED_ONLY = "UNCREDITED_ONLY";
}
