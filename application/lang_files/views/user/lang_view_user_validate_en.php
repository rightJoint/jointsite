<?php
class lang_view_user_validate_en extends lang_view_en
{
    function __construct()
    {
        $this->head["title"] = "Validation on site";
        $this->head["description"] = "Validation on site";
        $this->head["h1"] = "email validation";
        $this->vld_login = "login";
        $this->vld_alias = "alias";
        $this->vld_success = "success";
        $this->vld_txt_1 = "validation for user";
        $this->vld_txt_2 = "validation had success at";
        $this->vld_txt_3 ="Use menu to sign in site";
    }
}
