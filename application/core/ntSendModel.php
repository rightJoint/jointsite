<?php
class ntSendModel extends Model_pdo
{
    public $phpMailer;
    function __construct($sql_db_connect_json = SQL_CONN_DEFAULT)
    {
        parent::__construct($sql_db_connect_json);

        require_once ($_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR."/lib/php/PHPMailer.php");
        require_once ($_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR."/lib/php/SMTP.php");

        $this->phpMailer = new PHPMailer;
        $this->phpMailer->isSMTP();

        require_once (JOINT_SITE_CONF_DIR."/phpMailer-1.php");

        $this->phpMailer->CharSet = 'UTF-8';
        $this->phpMailer->Host = PHP_MAILER_HOST_1;
        $this->phpMailer->SMTPAuth = PHP_MAILER_SMTP_AUTH_1;
        $this->phpMailer->Username = PHP_MAILER_USER_NAME_1; // Ваш логин в Яндексе. Именно логин, без @yandex.ru
        $this->phpMailer->Password = PHP_MAILER_PASSWORD_1; //CONT_MAIL_1_PASS// Ваш пароль
        $this->phpMailer->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;;
        $this->phpMailer->Port = PHP_MAILER_PORT_1;
        $this->phpMailer->setFrom(PHP_MAILER_FROM_1); // Ваш Email
        $this->phpMailer->isHTML(PHP_MAILER_IS_HTML_1);
    }

    public function AddNtf(string $templateName, string $subscriber_type, string $type_id,
                           $template_params, $send_now, $method):bool
    {
        $findTemplate_qry = "select template_id from ntfTemplates_dt where template_id = '".$templateName."' or tName = '".$templateName."'";
        $findTemplate_res = $this->query($findTemplate_qry);
        if($findTemplate_res->rowCount() === 1){
            $findTemplate_row = $findTemplate_res->fetch(PDO::FETCH_ASSOC);
            $newNtf_id = $this->createGUID();
            $addNtf_qry = "insert into ntfList_dt (".
                "ntf_id, template_id, subscriber_type, type_id, add_date, template_params, send_params, send_date, created_by, send_res, send_log) values (".
                "'".$newNtf_id."', '".$findTemplate_row["template_id"]."', '".$subscriber_type."', '".$type_id."', ".
                "'".date("Y-m-d H:i:s")."', '".$template_params."', null, null, null, null, null)";
            if($this->query($addNtf_qry)){
                if($send_now){
                    $this->SendNtf($newNtf_id, $method);
                }
                return true;
            }
        }
    }

    public function SendNtf($ntf_id, $method)
    {
        $sendList_qry = "select * from ntfList_dt where send_date is null";
        if($ntf_id){
            $sendList_qry.=" and ntf_id='".$ntf_id."'";
        }

        $sendList_res = $this->query($sendList_qry);

        if($sendList_res->rowCount()){
            while ($sendList_row = $sendList_res->fetch(PDO::FETCH_ASSOC)){
                $send_res = array(
                    "result" => false,
                    "log" => null,
                    "put_ntf" => 0,
                    "send_flag" => 0,
                    "foundMail" => 0,
                    "sendToEmail" => 0,
                );

                if($sendList_row["subscriber_type"] == "user"){
                    $sendUser_res = $this->sendNtfForUser($sendList_row["ntf_id"], $sendList_row["type_id"]);
                    foreach ($sendUser_res as $rK => $rV){
                        if($rV){
                            $send_res[$rK]+=1;
                        }
                    }
                }elseif ($sendList_row["subscriber_type"] == "group"){
                    $groupUsers_qry = "select user_id from usersToGroups_dt where group_id='".$sendList_row["type_id"]."'";
                    $groupUsers_res = $this->query($groupUsers_qry);
                    if($groupUsers_res->rowCount()){
                        while ($groupUsers_row = $groupUsers_res->fetch(PDO::FETCH_ASSOC)){
                            $sendUser_res = $this->sendNtfForUser($sendList_row["ntf_id"], $groupUsers_row["user_id"]);
                            foreach ($sendUser_res as $rK => $rV){
                                if($rV){
                                    $send_res[$rK]+=1;
                                }
                            }
                        }
                    }else{
                        $send_res["log"] = "no subscribers in group<br>";
                    }
                }elseif($sendList_row["subscriber_type"] == "email"){
                    $template_qry = "select ntfTemplates_dt.tHeader_en, ntfTemplates_dt.tBody_en, ntfList_dt.subscriber_type, ".
                        "ntfList_dt.type_id, ntfList_dt.send_params, ntfList_dt.template_params from ntfTemplates_dt ".
                        "inner join ntfList_dt on ntfTemplates_dt.template_id = ntfList_dt.template_id where ntfList_dt.ntf_id='".$ntf_id."'";

                    $template_res = $this->query($template_qry);

                    if($template_res->rowCount() === 1){
                        $template_row = $template_res->fetch(PDO::FETCH_ASSOC);
                        $template_params = json_decode($template_row["template_params"], true);
                        $replaced_text = $template_row["tBody_en"];

                        if($template_params){
                            foreach ($template_params as $tp_key => $tp_val){
                                $replaced_text = str_replace("$^".$tp_key, $tp_val, $replaced_text);
                            }
                        }
                        $this->sendOnEmail($template_row["type_id"], $template_row["tHeader_en"], $replaced_text);

                        $send_res = array(
                            "result" => 1,
                            "log" => null,
                            "put_ntf" => 1,
                            "send_flag" => 1,
                            "foundMail" => 0,
                            "sendToEmail" => 1,
                        );
                    }
                }
                else{
                    $send_res["log"] = "unknown subscriber type<br>";
                }

                $res_text = "false";
                $log_text = $send_res["log"];

                if($send_res["put_ntf"]){
                    $log_text = "put_ntf: ".$send_res["put_ntf"].", send_flag: ".$send_res["send_flag"].", ".
                        "foundMail: ".$send_res["foundMail"].", sendToEmail: ".$send_res["sendToEmail"];
                    $res_text = "true";
                }

                $updateNtfList_qry = "update ntfList_dt set ".
                    "send_date='".date("Y-m-d H:i:s")."', ".
                    "send_res=".$res_text.", ".
                    "send_log = '".$log_text."' "."where ntf_id='".$sendList_row["ntf_id"]."'";
                $this->query($updateNtfList_qry);
            }
        }
    }

    function sendNtfForUser($ntf_id, $user_id)
    {
        $return = array(
            "put_ntf" => 0,
            "send_flag" => 0,
            "foundMail" => 0,
            "sendToEmail" => 0,
        );
        $template_qry = "select ntfTemplates_dt.tHeader_en, ntfTemplates_dt.tBody_en, ntfList_dt.subscriber_type, ".
            "ntfList_dt.type_id, ntfList_dt.send_params, ntfList_dt.template_params from ntfTemplates_dt ".
            "inner join ntfList_dt on ntfTemplates_dt.template_id = ntfList_dt.template_id where ntfList_dt.ntf_id='".$ntf_id."'";

        $template_res = $this->query($template_qry);

        if($template_res->rowCount() === 1){
            $template_row = $template_res->fetch(PDO::FETCH_ASSOC);
            if($template_row["subscriber_type"] == "group"){
                $findUserNtf_flag_qry = "select usersToGroups_dt.send_ntf, users_dt.eMail from usersToGroups_dt ".
                    "inner join users_dt on users_dt.user_id = usersToGroups_dt.user_id ".
                    "where usersToGroups_dt.user_id = '".$user_id."' and group_id = '".$template_row["type_id"]."'";
            }elseif ($template_row["subscriber_type"] == "user"){
                $findUserNtf_flag_qry = "select send_ntf, eMail from users_dt where user_id = '".$user_id."'";
            }

            $findUserNtf_flag_res = $this->query($findUserNtf_flag_qry);

            if($findUserNtf_flag_res->rowCount() === 1){
                $send_flag = "false";
                $findUserNtf_flag_row = $findUserNtf_flag_res->fetch(PDO::FETCH_ASSOC);

                if($findUserNtf_flag_row["send_ntf"]){
                    $return["send_flag"] = 1;
                    if($findUserNtf_flag_row["eMail"]){
                        $return["foundMail"] = 1;
                        $send_flag = "true";
                        $template_params = json_decode($template_row["template_params"], true);
                        $replaced_text = $template_row["tBody_en"];

                        if(isset($template_params) and is_array($template_params)){
                            foreach ($template_params as $tp_key => $tp_val){
                                $replaced_text = str_replace("$^".$tp_key, $tp_val, $replaced_text);
                            }
                        }
                        $this->sendOnEmail($findUserNtf_flag_row["eMail"], $template_row["tHeader_en"], $replaced_text);
                    }
                }
                $putNtf_qry = "insert into ntfRead_dt (ntf_id, user_id, read_date, put_date, send_flag) ".
                    "values (".
                    "'".$ntf_id."', ".
                    "'".$user_id."', ".
                    "null, ".
                    "'".date("Y-m-d H:i:s")."', ".
                    $send_flag.
                    ")";
                $this->query($putNtf_qry);

                $return["put_ntf"] = 1;

            }
        }
        return $return;
    }

    function sendOnEmail($email, $subject, $body)
    {
        $this->phpMailer->addAddress($email); // Email получателя
        $this->phpMailer->Subject = $subject;
        $this->phpMailer->Body = $body;
        $this->phpMailer->send();
    }
}