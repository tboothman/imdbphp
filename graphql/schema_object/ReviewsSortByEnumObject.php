<?php

namespace GraphQL\SchemaObject;

class ReviewsSortByEnumObject extends EnumObject
{
    const HELPFULNESS_SCORE = "HELPFULNESS_SCORE";
    const SUBMISSION_DATE = "SUBMISSION_DATE";
    const SUBMITTER_REVIEW_COUNT = "SUBMITTER_REVIEW_COUNT";
    const TOTAL_VOTES = "TOTAL_VOTES";
    const USER_RATING = "USER_RATING";
}
