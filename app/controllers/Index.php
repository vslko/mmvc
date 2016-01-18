<?php
class IndexController extends AbstractController {
    
    public function init( $R ) {
        parent::init($R);
    }
    
    public function do_( $R ) {
		VIEW::template("index");
        VIEW::set("vars", $this->getCollection('Variables')->getAll() );
		VIEW::show();
	}

}