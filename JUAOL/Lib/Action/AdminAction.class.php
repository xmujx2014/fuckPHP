<?php
class AdminAction extends Action {
    public function index(){
    	$this->assign($data)->display('admin');
    }
    public function login(){
    	
    	$this->redirect('User/index');
    }
}