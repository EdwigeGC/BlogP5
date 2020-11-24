<?php

namespace App\entity; 


class Field
{
    private $label, //titre du champs
            $name, // nom du champs
            $value; //type de valeur (string, int,...)


    public function __construct(array $options = [])
    {
    if (!empty($options))
    {
        $this->hydrate($options);
    }
    }

    public function hydrate($data)
  {
    foreach ($data as $key => $value)
    {
      $method = 'set'.ucfirst($key);
      
      if (is_callable([$this, $method]))
      {
        $this->$method($value);
      }
    }
  }


    // SETTERS //
    
    public function setLabel($label)
    {
        $this->label= (string) $label;
    }

    public function setName($name)
    {
        $this->name= (string) $name;
    }

    public function setValue($value)
    {
        $this->value= $value;
    }



    //GETTER
    public function label()
    {
        return $this->label;
    }

    public function name()
    {
        return $this->name;
    }

    public function value()
    {
        return $this->value;
    }

}