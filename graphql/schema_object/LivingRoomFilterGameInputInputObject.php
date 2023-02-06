<?php

namespace GraphQL\SchemaObject;

class LivingRoomFilterGameInputInputObject extends InputObject
{
    protected $answerIds;
    protected $gameTypeId;
    protected $questionId;

    public function setAnswerIds(array $answerIds)
    {
        $this->answerIds = $answerIds;

        return $this;
    }

    public function setGameTypeId($gameTypeId)
    {
        $this->gameTypeId = $gameTypeId;

        return $this;
    }

    public function setQuestionId($questionId)
    {
        $this->questionId = $questionId;

        return $this;
    }
}
