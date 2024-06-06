<?php
class view_validate extends SiteView
{
    public $logo = JOINT_SITE_EXEC_DIR."/img/popimg/checkinNow.png";
    public $shortcut_icon = JOINT_SITE_EXEC_DIR."/img/popimg/checkinNow.png";

    public $robot_no_index = true;
    public $metrik_block = false;

    function LoadViewLang_custom()
    {
        parent::LoadViewLang_custom();
        require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
            "/application/lang_files/views/user/lang_view_user_validate_".$_SESSION[JS_SAIK]["lang"].".php";
        return "lang_view_user_validate_".$_SESSION[JS_SAIK]["lang"];
    }

    function print_page_content()
    {
        echo "<div class='contentBlock-frame'><div class='contentBlock-center'>".
            "<div class='contentBlock-wrap'>";
        if($this->view_data["status"]){
            echo "<p>".$this->lang_map->vld_txt_1." ".
                $this->lang_map->vld_login.": ".
                $this->view_data["accLogin"]." (".$this->lang_map->vld_alias.": ".
                $this->view_data["accAlias"].") ".$this->lang_map->vld_success.".</p>".
            "<p>".$this->lang_map->vld_txt_3."</p>";
        }else{
            echo "<p>".$this->lang_map->vld_txt_2." ".$this->view_data["validDate"]." for user ".$this->lang_map->vld_login.
                ": ".$this->view_data["accLogin"]." (".$this->lang_map->vld_alias.": ".$this->view_data["accAlias"].")".
                "<p>".$this->lang_map->vld_txt_3."</p>";
        }

        echo "</div></div></div>";
    }
}