<?php
namespace Ns\Dashboard\Models\Test;

class RobotsParts extends \Phalcon\Mvc\Model
{

    public $id;

    public $robots_id;

    public $parts_id;

    public function initialize()
    {
        $this->belongsTo("robots_id", "Ns\Dashboard\Models\Test\Robots", "id");
        $this->belongsTo("parts_id", "Ns\Dashboard\Models\Test\Parts", "id");
    }

}