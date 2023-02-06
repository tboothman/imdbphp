<?php

namespace GraphQL\SchemaObject;

class QuestionQueryObject extends QueryObject
{
    const OBJECT_NAME = "Question";

    public function selectAnswerOptions(QuestionAnswerOptionsArgumentsObject $argsObject = null)
    {
        $object = new AnswerOptionQueryObject("answerOptions");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectAnswerType()
    {
        $this->selectField("answerType");

        return $this;
    }

    public function selectContributionLink(QuestionContributionLinkArgumentsObject $argsObject = null)
    {
        $object = new ContributionQuestionsLinkQueryObject("contributionLink");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectDataType()
    {
        $this->selectField("dataType");

        return $this;
    }

    public function selectEntity(QuestionEntityArgumentsObject $argsObject = null)
    {
        $object = new EntityUnionObject("entity");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectEntityId()
    {
        $this->selectField("entityId");

        return $this;
    }

    public function selectQuestionId()
    {
        $this->selectField("questionId");

        return $this;
    }

    public function selectQuestionText(QuestionQuestionTextArgumentsObject $argsObject = null)
    {
        $object = new MarkdownQueryObject("questionText");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
