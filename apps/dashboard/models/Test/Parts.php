<?php
namespace Ns\Dashboard\Models\Test;

class Parts extends \Phalcon\Mvc\Model
{

    public $id;

    public $name;

    public function initialize()
    {
        $this->hasMany("id", "Ns\Dashboard\Models\Test\RobotsParts", "parts_id");
    }

}