<?php


namespace Sunfire\Cookie\Traits;


trait Fillable
{
    public function __construct()
    {
        foreach ($this->fill() as $key => $value) {

            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }

        if (method_exists($this, 'cookies')) {
            $this->cookies = $this->cookies();
        }
    }
}