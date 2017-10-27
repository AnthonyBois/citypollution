<?php

namespace Formation\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * City
 *
 * @ORM\Table(name="city", uniqueConstraints={@ORM\UniqueConstraint(name="city_name", columns={"city_name"}), @ORM\UniqueConstraint(name="city_api_name", columns={"city_api_name"})})
 * @ORM\Entity
 */
class City
{
    /**
     * @var string
     *
     * @ORM\Column(name="city_name", type="string", length=64, nullable=false)
     */
    private $cityName;

    /**
     * @var string
     *
     * @ORM\Column(name="city_api_name", type="string", length=64, nullable=false)
     */
    private $cityApiName;

    /**
     * @var integer
     *
     * @ORM\Column(name="city_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $cityId;



    /**
     * Set cityName
     *
     * @param string $cityName
     *
     * @return City
     */
    public function setCityName($cityName)
    {
        $this->cityName = $cityName;

        return $this;
    }

    /**
     * Get cityName
     *
     * @return string
     */
    public function getCityName()
    {
        return $this->cityName;
    }

    /**
     * Set cityApiName
     *
     * @param string $cityApiName
     *
     * @return City
     */
    public function setCityApiName($cityApiName)
    {
        $this->cityApiName = $cityApiName;

        return $this;
    }

    /**
     * Get cityApiName
     *
     * @return string
     */
    public function getCityApiName()
    {
        return $this->cityApiName;
    }

    /**
     * Get cityId
     *
     * @return integer
     */
    public function getCityId()
    {
        return $this->cityId;
    }
}
