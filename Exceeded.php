<?php
  class Exceeded {

    protected $total_count = 1;
    protected $count = 0;
    protected $label = '';
    protected $exceeded_ret_val = TRUE;
    protected $not_exceeded_ret_val = FALSE;
    protected $max_default = 5;
    protected $max_total = 0;
    protected $max= array();

    public function maxTotal($max_total){
      $this->max_total = $max_total;
      return $this;
    }

    public function maxDefault($max_default){
      $this->max_default = $max_default;
      return $this;
    }

    public function max(array $max_array){
      $this->max = $max_array;
      return $this;
    }

    public function whenExceeded($ret_val) {
      $this->exceeded_ret_val = $ret_val;
      return $this;
    }

    public function whenNotExceeded($ret_val) {
      $this->not_exceeded_ret_val = $ret_val;
      return $this;
    }

    public function add($tag){
      // Cuenta las repeticiones sucesivas de $tag.
      // A partir del máximo fijado para cada tag comienza a devolver TRUE o el valor especificado, por ejemplo "exceded"
      if($tag != $this->label){
        $this->count = 0;
        $this->label = $tag;
      }
      if(!isset($this->max[$tag])) { $this->max[$tag] = $this->max_default; }
      $this->count++;
      if($this->count > $this->max[$tag] ||
         ($this->max_total > 0 && $this->total_count > $this->max_total)
        ) {
        return $this->exceeded_ret_val;
      }
      $this->total_count++;
      return $this->not_exceeded_ret_val;
    }

    public function labels(){
      return $this->max;
    }
  }


