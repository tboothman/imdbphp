<?php

namespace GraphQL\SchemaObject;

class UserFeedbackGivenArgumentsObject extends ArgumentsObject
{
    protected $input;

    public function setInput(FeedbackGivenInputInputObject $feedbackGivenInputInputObject)
    {
        $this->input = $feedbackGivenInputInputObject;

        return $this;
    }
}
