<?php
class lang_view_productJointPass_en extends lang_view_en
{
    function __construct()
    {
        $this->head["title"] = "jointPass - product";
        $this->head["h1"] = "jointPass - product";

        $this->prod_about = "Passwords organizer. No needs keep in mind all passwords of yours accounts, remember only one Master Pass of this app.";
        $this->head["description"] = $this->head["title"].": ".$this->prod_about;


        $this->product_info = array(
            "h2_сontent" => "Table of content",
            "h2_dwl" => "Download jointPass",
            "h2_common" => "GUI",
            "h2_craft" => "Principles of work",
            "h2_feedback" => "Feedback",
        );
        $this->jp_feedback = array(
            "p1" => "If you have any other questions about jointPass, please text me on my eMail",
        );
        $this->jp_dwl = array(
            "a_title" => "download",
            "p1_txt1" => "archive contains app",
            "p1_txt2" => "Unpack jointPass.zip, make directory where from you going to run app, and put there jointPass.exe from archive.",
            "p2" => "To check control summ you might use <span class='ex-conf'>CertUtil</span> from terminal. ".
                "Hash MD5 must be equal",
            "ex-text1" => "Check  <span class='ex-conf'>Hash MD5</span>",
            "p3" => "Repository also avaliable for download, who wanna see code.",
            "ex-text2" => "clone repository jointpass",
        );
        $this->jp_gui = array(
            "p1" => "App check settings file <span class='ex-conf'>jPass.ini</span> every run in directory where from it runs, and the first run creates this file. ".
                "You may not delete jPass.ini, though if you drop .ini-file, you can retrive it and passwords from jPass_data if you remember Master Pass.",
            "p2" => "Enter Master Pass and repeat, choose interface language and folder to store data, by default ".
                " offer users directory <span class='ex-conf'>C:\Users\CurrentUser\Documents\jPass_data</span>",
            "example-text-1" => "First auth win",
            "p3" => "Next time auth will go in general mode.",
            "p4" => "One day you might want change Master Pass, click checkbox close to left bottom corner of auth win ".
                "to active change pass mode.",
            "example-text-2" => "Change password win. App return quantities of accounts and fields that was re-crypted",
            "p5" => "After your get in, main window of app will be shown, from there by buttons on special panel available another windows.",
            "example-text-3" => "Main window of app, left side for filters, right side for accounts.",
            "p6" => "On left side groups and categories use to filter accounts on right side.",
            "p7" => "Tap on account row and buttons to copy clipboard login and password just appear on filter panel.",
            "p8" => "You may filter accounts in date grid by last update password date.",
            "p9" => "Double click on account row invoke account fields window, because you may store and crypt custom fields.",
            "example-text-4" => "Account fields window",
            "p10" => "At the up of main windows on apart panel disposed buttons to open groups, categories, fields lis and accounts windows.<br>".
                "<strong>For displaying mostly modifies in these windows on main window attend Refresh buttons on filter panels. ".
                "Some kind of changes will be applying after restart app.</strong>",
            "p11" => "Groups and categories intend to classify and filter accounts, ".
                "the only different between them is categories on main window in datagrid control, and groups in drop down control.",
            "example-text-5" => "Groups window",
            "p12" => "You may attach image to groups, categories and fields in list.<br>".
                "<strong>App doesn't handle loaded images, better load icon, not photos in high definition.</strong>",
            "example-text-6" => "Categories window",
            "p13" => "Sometime you might want to attach to account, more then login and password, some another info, ".
                "for example access token git hub or ip-address. For this purpose create custom fields, turn on/of encryption.",
            "example-text-7" => "Fields(list) window",
            "p14" => "Create new account, double click invoke open account's fields window. Don't forget press ".
                "<span class='ex-conf'>Update button</span> to reload accounts grid in main window.",
            "example-text-8" => "Accounts window",
        );
        $this->jp_craft = array(
            "p1" => "Each time when user sign in, app read file <span class='ex-conf'>jPass.ini</span> from directory where it runs, takes from there salt (general GUID), ".
                "that add to entered password, then calc summ's hash, and compare with hash in jPass.ini. ".
                "At the end makes new salt and calc new hash, rewrites jPass.ini",
            "p2" => "Entered in auth window Master Pass stored in system RAM while jointPass.exe is running, ".
                "it used for encryption and decryption fields of accounts. Decrypted password of account stored in RAM ".
                "in controls while you access fields.",
            "example-text-1" => "Example of encryption word <span class='ex-conf'>silver</span> on Master Pass <span class='ex-conf'>123</span>",
            "p3" => "Principles of encryption accounts data based on ".
                "<a href='https://gist.github.com/Echo-Peak/b93ed94c48048a7041215d4a3f4ad0a2' title='snippet from git hub'>this one snippet</a>. ".
                "It used once to be easy modified for new options.</p>".
                "<strong>I'm not so familiar with cryptography algorithms or gather metadata, ".
                "I really don't know any ways how to break this app, but it doesn't mean it is not possible.</strong>",
            "p4" => "Folder to store users data sets in <span class='ex-conf'>jPass.ini</span>, by default it is ".
                "<span class='ex-conf'>C:\Users\CurrentUser\Documents\jPass_data</span> contains files ".
                "for groups, categories, fields list and accounts. ".
                "Folder <span class='ex-conf'>accounts</span> use for store accounts fields.",
            "example-text-2" => "Folder contains users data",
            "p5" => "<strong>To apply changes, file accounts.pass, each time fully rewritten. For test was used 25 accounts, ".
                "guess it is possible to use more, however it's not database to store thousands passwords.</strong>",
        );
    }
}
