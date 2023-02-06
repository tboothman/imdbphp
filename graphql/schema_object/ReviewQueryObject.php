<?php

namespace GraphQL\SchemaObject;

class ReviewQueryObject extends QueryObject
{
    const OBJECT_NAME = "Review";

    public function selectAuthor(ReviewAuthorArgumentsObject $argsObject = null)
    {
        $object = new UserProfileQueryObject("author");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectAuthorRating()
    {
        $this->selectField("authorRating");

        return $this;
    }

    public function selectHelpfulness(ReviewHelpfulnessArgumentsObject $argsObject = null)
    {
        $object = new ReviewHelpfulnessQueryObject("helpfulness");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectLanguage()
    {
        $this->selectField("language");

        return $this;
    }

    public function selectReportingLink(ReviewReportingLinkArgumentsObject $argsObject = null)
    {
        $object = new ContributionLinkQueryObject("reportingLink");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectSpoiler()
    {
        $this->selectField("spoiler");

        return $this;
    }

    public function selectSubmissionDate()
    {
        $this->selectField("submissionDate");

        return $this;
    }

    public function selectSummary(ReviewSummaryArgumentsObject $argsObject = null)
    {
        $object = new ReviewSummaryQueryObject("summary");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectText(ReviewTextArgumentsObject $argsObject = null)
    {
        $object = new ReviewTextQueryObject("text");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTitle(ReviewTitleArgumentsObject $argsObject = null)
    {
        $object = new TitleQueryObject("title");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
