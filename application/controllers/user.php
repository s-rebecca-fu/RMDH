<?php

/**
 * Created by PhpStorm.
 * User: rebec
 * Date: 5/3/2017
 * Time: 11:53 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'controllers/homepage.php');

class user extends Application
{
    public function index() {
        $this->data['pagebody'] = 'homepage';
        $this->data['message'] = '<br>';
        $this->render();
    }
    /**
     * @return array
     */
    public function check()
    {
        if($this->checkPwd($_POST["user"],$_POST["pwd"])) {
            $this->session->set_userdata('user', $_POST["user"]);
            $this->data['menubar'] = $this->parser->parse("menubar", $this->data, true);
            $this->data['user'] = $_POST["user"];
            $this->data['footer'] = $this->parser->parse('footer', $this->data, true);
            $this->data['pagebody'] = "management";
        } else {
            $this->data['message'] = "<div class='col-md-11 alert alert-danger'> Please verify your username and password"."</div>";
            $this->data['pagebody'] = "homepage";
        }
        return $this->render();
    }

    public function checkPwd($user,$pwd) {
        $temppwd = $this->adminuser->getPassword($user);
        if(base64_decode($temppwd) == $pwd && $pwd != null && $user!="") {
            return true;
        }
        return false;
    }

    public function addUser() {
        $this->data["error"] = "<div></div>";
        $this->data['menubar'] = $this->parser->parse("menubar", $this->data, true);
        $this->data['footer'] = $this->parser->parse('footer', $this->data, true);
        $this->data['pagebody'] = "userform";
        $this->render();
        //http://comp4711.backend/user/addUser
    }

    public function verify(){
        if($_POST["pwd"] == $_POST["confirm"]) {
            $resultArray = array(
                'username' => $_POST["username"],
                'password' => base64_encode($_POST["pwd"])
            );
            $this->db->insert("adminuser",$resultArray);
            $this->data["error"] = "<div class='span11 alert alert-success'>add admin user successfully</div><br>";
        } else {
            $this->data["error"] = "<div class='span11 alert alert-danger'>your password doesn't match</div><br>";
        }
        $this->data['menubar'] = $this->parser->parse("menubar", $this->data, true);
        $this->data['pagebody'] = "userform";
        $this->render();
    }

    public function logout() {
        $this->session->unset_userdata('user');
        $this->session->sess_destroy();
        $this->data['pagebody'] = "homepage";
        $this->data['message'] = '<br>';
        $this->render();
    }
}