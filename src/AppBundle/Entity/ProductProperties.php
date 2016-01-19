<?php
/**
 * Created by IntelliJ IDEA.
 * User: bahtiyar
 * Date: 19-1-16
 * Time: 17:32
 */

namespace AppBundle\Entity;


trait ProductProperties
{
    /**
     * @var string
     */
    private $name;

    /**
     * @param string $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}