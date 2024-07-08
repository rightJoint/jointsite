<?php
class lang_view_landing_en extends lang_view_en
{
    function __construct()
    {
        $this->head["h1"] = "Developer Services";
        $this->head["title"] = "Hired programmer";
        $this->head["description"] = "Hired programmer RightJoint: programming on php and c#. Creating and support software. ".
            "Free product jointPass - password organizer, download. ".
            "Pop services: php, c#, js, html, git, ";
        $this->titleblock = array(
            "invoke" => "Programming on php and c#",
            "invoke-cm" => "Developing new and maintenance existing software, business process automation",
            "st-txt1" => "Analytical approach",
            "st-txt2" => "Responsible for the execution",
            "st-txt3" => "Solving complex problems",
            "thought" => "By entrusting your tasks to a specialist, you do not have to worry that everything ".
                "will be done correctly and on time.",
            "cb-txt" => "Call now",
            "advantages-list-1" => "More than 10 years of experience in the IT field",
            "advantages-list-2" => "Good reputation",
            "advantages-list-3" => "Work experience in the bank",
            "advantages-list-4" => "Without intermediaries",
            "advantages-list-5" => "Flexible pricing and discount system",
            "ask-q-1" => "Ask me your questions on",
            "ask-q-2" => "Telegram",
            "ask-q-3" => "or",
            "ask-q-4" => "leave a request",
            "ask-q-5" => "on this site",
        );
        $this->producth2 = "My products - freeware";
        $this->pops = array(
            "h2" => "Pop services",
            "btn-buy" => "Buy",
            "more-txt" => "one more",
        );
        $this->contactsblock = array(
            "address-f" => "Address",
            "address-v" => "Russia, Ivanovo, 8-Match st., b. 32, «Silver city» mall, public hall",
            "Schedule-f" => "Schedule",
            "Schedule-v" => "mon. - fri. 9.00 am - 6.00pm +4 UTC, sat., sun. - days off",
            "phone-f" => "Phone",
        );
        $this->jointpass = array(
        "title" => "joint-pass",
        "p1" => "Passwords organizer. No needs keep in mind all passwords of yours accounts, remember only one Master Pass of this app. ",
        "p2" => "Tap on account row in grid and buttons to copy clipboard login and password just appear on filter panel. ".
            "All data store encrypted in yor disk. You may sort out your accounts by groups and categories.",
        "p3" => "In addition two predefined fields (login and password) you may add custom fields, attach to that images, turn on encryption. ".
            "Account may contain any unique fields.",
        "p4" => "Watch when your password was last updated just sort them in grid by date. ".
            "Your may migrate you data to use on another PC. ".
            "It is possible to change MasterPass, app re-crypt data.",
        "a_title" => "get app jointPass",
        "a_text" => "Download",
        "arrow" => "learn more",
        "h2" => "My products - freeware",
    );
    }
}