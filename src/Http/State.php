<?php

namespace App\Http;
    
use App\Interfaces\StateInterface;

class State implements StateInterface
{
    private $currentPage;
    private $orderBy; //column number
    private $order;
    private $rowsPerPage;
    
    public function getCurrentPage(): int
    {
        return $this->currentPage;
    }

    public function getOrderBy(): string
    {
        return $this->orderBy;
    }

    public function isOrderDesc(): bool
    {
        return ($this->order == 'desc') ? true : false;
    }

    public function isOrderAsc(): bool
    {
        return ($this->order == 'asc') ? true : false;
    }

    public function getRowsPerPage(): int
    {
        return $this->rowsPerPage;
    }
    
    public function __get($key)
    {
        if (property_exists($this, $key)) {
            return $this->{$key};
        } else {
            return null; // or throw an exception
        }
    }
    
    public function __set($property, $value)  
    {  
        if (property_exists($this, $property)) {  
            if(is_null($this->$property)){
                $this->$property = $value;
                return $this;
            }
            throw new \Exception('Variable already set');
        }
        throw new \Exception('Undefined variable');
    }
}
