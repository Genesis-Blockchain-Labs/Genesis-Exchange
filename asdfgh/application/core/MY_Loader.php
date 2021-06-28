<?php
class MY_Loader extends CI_Loader {
    public function template($template_name, $vars = array(), $return = FALSE)
    {
        if($return):
        $content  = $this->view('include/header', $vars, $return);
        $content  = $this->view('include/left_side_menu', $vars, $return);
        $content  = $this->view('include/head', $vars, $return);
        $content .= $this->view($template_name, $vars, $return);
        $content .= $this->view('include/footer', $vars, $return);
        return $content;
    else:
        $this->view('include/header', $vars);
        $this->view('include/left_side_menu', $vars);
        $this->view('include/head', $vars);
        $this->view($template_name, $vars);
        $this->view('include/footer', $vars);
    endif;
    }
}
?>