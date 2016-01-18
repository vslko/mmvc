<?php
class VariablesCollection extends MantellaCollection {

    protected $MODEL = "Variable";
    
    // overrride getAll function
    public function getAll() {
        $this->dbLoad();
        
        $res = array();
        while( $var = $this->next() ) {
            $res[] = $var->toData();
		}
        return $res;        
    }

}