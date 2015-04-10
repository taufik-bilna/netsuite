<?php
namespace Ns\Dashboard\Models\Test;

class Robots extends \Phalcon\Mvc\Model
{
    public $id;

    public $name;

    public function initialize()
    {
        $this->hasManyToMany(
            "id",
            "Ns\Dashboard\Models\Test\RobotsParts",
            "robots_id", "parts_id",
            "Ns\Dashboard\Models\Test\Parts",
            "id",
            array(
            	'alias' => 'robotsParts'
            )
        );
    }

}