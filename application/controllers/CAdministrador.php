<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CAdministrador extends CI_Controller {

    public function index()
    {
        $this->load->view('includes/VHeader');
        $this->load->view('administrador/VMenu_bar');
        $this->load->view('submissor/VDashboard');
        $this->load->view('includes/VFooter');
    }
}
