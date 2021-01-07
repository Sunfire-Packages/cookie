<?php


namespace Sunfire\Cookie\Traits;


trait Describable
{
    public $name;
    public $description;
    public $required;
    public $checked = true;

    abstract public function fill(): array;
}