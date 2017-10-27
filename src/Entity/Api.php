<?php

namespace Formation\Entity;

use Doctrine\ORM\Mapping as ORM;
use Formation\Entity\City;

/**
 * Api
 *
 * @ORM\Table(name="api", uniqueConstraints={@ORM\UniqueConstraint(name="city_id_2", columns={"city_id"}), @ORM\UniqueConstraint(name="city_id", columns={"city_id"})})
 * @ORM\Entity
 */
class Api
{
    /**
     * @var string
     *
     * @ORM\Column(name="api_json", type="text", length=65535, nullable=false)
     */
    private $apiJson;

    /**
     * @var integer
     *
     * @ORM\Column(name="api_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $apiId;

    /**
     * @var \Formation\Entity\City
     *
     * @ORM\ManyToOne(targetEntity="\Formation\Entity\City",cascade={"persist", "remove"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="city_id", referencedColumnName="city_id")
     * })
     */
    private $city;



    /**
     * Set apiJson
     *
     * @param string $apiJson
     *
     * @return Api
     */
    public function setApiJson($apiJson)
    {
        $this->apiJson = $apiJson;

        return $this;
    }

    /**
     * Get apiJson
     *
     * @return string
     */
    public function getApiJson()
    {
        return $this->apiJson;
    }

    /**
     * Get apiId
     *
     * @return integer
     */
    public function getApiId()
    {
        return $this->apiId;
    }

    /**
     * Set city
     *
     * @param \Formation\Entity\City $city
     *
     * @return Api
     */
    public function setCity(City $city = null)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return \Formation\Entity\City
     */
    public function getCity()
    {
        return $this->city;
    }
}
