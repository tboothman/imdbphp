<?php

namespace GraphQL\SchemaObject;

class ProductionStageFilterEnumObject extends EnumObject
{
    const ABANDONED = "ABANDONED";
    const COMPLETED = "COMPLETED";
    const IN_DEVELOPMENT = "IN_DEVELOPMENT";
    const IN_PRODUCTION = "IN_PRODUCTION";
    const POST_PRODUCTION = "POST_PRODUCTION";
    const PRE_PRODUCTION = "PRE_PRODUCTION";
    const RELEASED = "RELEASED";
}
