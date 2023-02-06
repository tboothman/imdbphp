<?php

namespace GraphQL\SchemaObject;

class DemographicFilterInputObject extends InputObject
{
    protected $age;
    protected $country;
    protected $gender;
    protected $userCategory;

    public function setAge($age)
    {
        $this->age = $age;

        return $this;
    }

    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    public function setUserCategory($userCategory)
    {
        $this->userCategory = $userCategory;

        return $this;
    }
}
