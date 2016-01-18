<?php
class VariableModel extends MantellaModel {

    // --- base properties ---
    protected $PRIMARY_KEY = 'VARIABLE_NAME';

    protected $FIELDS = array(
                                  'VARIABLE_NAME'	=> "str",
                                  'VARIABLE_VALUE'	=> "str",
    );

    // --- extended database's properties ---
    protected $DATABASE     = "db";
    protected $TABLE        = "GLOBAL_VARIABLES";


	public function toData() {
		return array(
				'key'		=> $this->get('VARIABLE_NAME'),
                'value'		=> $this->get('VARIABLE_VALUE'),
		);
	}

}
