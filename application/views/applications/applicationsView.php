<?php
class applicationsView extends SiteView
{
    function __construct()
    {
        parent::__construct();
        $this->scripts[]= JOINT_SITE_EXEC_DIR."/lib/js/tinymce/js/tinymce/tinymce.min.js";
        $this->scripts[] = JOINT_SITE_EXEC_DIR."/js/applications/defaultForm.js";
        $this->styles[] = JOINT_SITE_EXEC_DIR."/css/applications/detail.css";
    }

    function print_page_content()
    {
        $srvApplBasket = null;
        if(is_array($this->view_data["basket"])){
            foreach ($this->view_data["basket"]["prod"] as $prodAlias=>$prodInfo){
                $prodCost = $prodInfo["count"]*$prodInfo["cardPrice_".$_SESSION[JS_SAIK]["lang"]];
                $srvApplBasket.= "<div class='appl-basket-line'>".
                    $prodInfo["cardName_".$_SESSION[JS_SAIK]["lang"]]." =".$prodInfo["count"];
                $srvApplBasket.= "(".$prodInfo["unit_".$this->view_data["basket"]["lang"]].")";
                $srvApplBasket.= "* ".$prodInfo["cardPrice_".$_SESSION[JS_SAIK]["lang"]]." = ".$prodCost." ".$prodInfo["cardCurr_".$_SESSION[JS_SAIK]["lang"]].
                    "</div>";
            }
        }else{
            $srvApplBasket.= "Нет списка услуг";
        }

        if ($this->view_data["basket"]["lang"] == "en"){
            $b_curr = "$";
        }else{
            $b_curr = "руб";
        }

        echo
            "<div class='contentBlock-frame'>".
            "<div class='contentBlock-center'><div class='contentBlock-wrap'>".
            "<div class='apl-detail'>".

            "<div class='client-info'>".
            "<div class='apd-cap'>Клиент</div>".
            "<div class='ci-img'><img src='/img/popimg/avatar-default.png'></div>".
            "<div class='cid-name'><span>".$this->view_data["rd"]["clientName"]["curVal"]."</div>".
            "</div>".
            "<div class='invoice-info'>".
            "<div class='apd-cap'>Заявка</div>".
            "<div class='ii-status'><span class='st-var'>Статус:</span><span class='st-val'>".$this->view_data["rd"]["status"]["curVal"]."</span></div>".
            "<div class='ii-date'><span class='st-var'>Дата:</span><span class='st-val'>".$this->view_data["rd"]["dateEntered"]["curVal"]."</span></div>".
            "<div class='ii-amount'><span class='st-var'>Сумма:</span><span class='st-val'>".$this->view_data["basket"]["total"]." ".$b_curr."</span></div>".
            "</div>".
            "<div class='c-cont-info'>".
            "<div class='apd-cap'>Контакты</div>".
            "<div class='ci-detail'>".
            "<div class='cid-mail'><img src='/img/popimg/eMailLogo-2.png'><span>".$this->view_data["rd"]["clientMail"]["curVal"]."</span></span></div>";
        if(isset($this->view_data["rd"]["clientPhone"]["curVal"])){
            echo "<div class='cid-phone'><img src='/img/Services/typeNum.png'><span>".$this->view_data["rd"]["clientPhone"]["curVal"]."</span></span></div>";
        }
        echo "</div>".
            "</div>".
            "<div class='appl-basket'>".
            "<div class='apd-cap'>Услуги на сайте</div>";
        echo $srvApplBasket;

        echo "</div>".
            "<div class='c-subject'>".
            "<div class='apd-cap'>Описание</div>".
            "<div class='cs-content'>";
        if(isset($this->view_data["rd"]["clientSubject"]["curVal"])){
            echo $this->view_data["rd"]["clientSubject"]["curVal"];
        }else{
            echo "Описание не задано";
        }
        echo "</div></div>";


        $return = null;

        $return.= "<hr>".
            "<form class='aplc-form' enctype='multipart/form-data' method='post'>".
            "<div class='aplcf-title'>";
        if(isset($_SESSION[JS_SAIK]["site_user"]['user_id'])){
            if (isset($_SESSION[JS_SAIK]["site_user"]["avatar"])) {
                $avatar_img = USERS_AVATARS_DIR . "/" . $_SESSION[JS_SAIK]["site_user"]["avatar"];
            }else{
                $avatar_img = JOINT_SITE_EXEC_DIR . "/img/popimg/avatar-default.png";
            }
            $return.="<img src='".$avatar_img."'>".$_SESSION[JS_SAIK]["site_user"]['accAlias'].
                "<span>Добавить коммент:</span></div><div class='cfForm-err'></div>";
        }else{
            $return.="<img src='/img/popimg/avatar-default.png'>".$this->view_data["rd"]["clientName"]["curVal"].
                "<span>Добавить коммент:</span></div><div class='cfForm-err'></div>";
        }
        $return.= "<input type='hidden' name='appl-f-nc' value='y'>";
        $return.=//"<input type='hidden' name='appl_id' value='".$art_id."'>".
            "<div class='cmForm-area'>".
            "<textarea name='content' id='artCm' class='apl-form-editor'></textarea></div>";
        if(isset($this->view_data["rdCm"]["err"]["content"])){
            $return.="<div class='apll-f-err'>".$this->view_data["rdCm"]["err"]["content"]."</div>";
        }
        $return.="<div class='aplcf-ctrl'>".
            "<div class='aplcf-ctrl-block'>"."<input type='file' name='applFiles[]' accept='image/jpeg,image/png,image/gif' multiple>"."</div>".
            "<div class='aplcf-ctrl-block'>".
            "<input type='submit' value='Написать'>";
        if (isset($_SESSION[JS_SAIK]['groups']['1']) and $_SESSION[JS_SAIK]['groups']['1']>10) {
            $return.="<input type='button' value='Переписать' onclick='rewriteApplCom(".'"new"'.")'>";
        }
        $return.="</div></div></form>";
        echo "</div>".
            "<div class='appl-attach'>".
            "<div class='apt-title'>Коментарии и вложения (".$this->view_data["findApplCm"]->rowCount()."): </div>";

        while ($applCm_row = $this->view_data["findApplCm"]->fetch(PDO::FETCH_ASSOC)){
            $applCmClass = null;
            if(isset($applCm_row["group_id"])){
                $applCmClass = "manag";
            }
            echo "<div class='applCm ".$applCmClass."'>".
                "<div class='usr-line'>";
            if($applCm_row["user_id"]){
                if($applCm_row["photoLink"]){
                    echo "<img src='".USERS_AVATARS_DIR."/".$applCm_row["photoLink"]."'>".$applCm_row["accAlias"];
                }else{
                    echo "<img src='/img/popimg/avatar-default.png'>".$applCm_row["accAlias"];
                }

            }else{
                echo $this->view_data["rd"]["clientName"]["curVal"]."<img src='/img/popimg/avatar-default.png'>";
            }

            echo "</div>";
            echo "<div class='content'><div class='c-wrap'>".$applCm_row["content"]."</div></div>";

            if($applCm_row["attach"]){
                $applCmAttach = json_decode($applCm_row["attach"], true);
                echo "<div class='cm-attach'>";
                foreach ($applCmAttach as $aFile){
                    echo "<a href='".APPL_UPLOAD_FOLDER."/".$applCm_row["appl_id"]."/".$aFile."' download>".$aFile."</a><br>";
                }

                echo "</div>";
            }else{
                echo "no-attach";
            }
            echo "<div class='cm-date'>Написал(а):".$applCm_row["dateEntered"]."</div>".
                "</div>";
        }
        echo    $return.
            "</div>".
            "</div>".
            "</div>".
            "</div>";




    }
}