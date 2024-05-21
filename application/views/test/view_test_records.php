<?php
class view_test_records extends view_test
{
    function print_page_content()
    {
        echo "<div class='contentBlock-frame'><div class='contentBlock-center'>".
            "<div class='contentBlock-wrap'>".
            "<h3>Список тестов ветки Запись</h3>".
            "<p>Чтобы открыть таблицу (список и записи), используйте адерес /table/table_name, где table_name - имя таблицы в БД</p>".
            "<p>Например <a href='".JOINT_SITE_EXEC_DIR."/test/records/table/musictrackstoalb_dt'>".
            JOINT_SITE_EXEC_DIR."/test/records/table/musictrackstoalb_dt"."</a> покажет таблицу musicalb как в примере 1, ".
            "но без кастомной модели.</p>".
            "<p>Для примера используются три кастомные модели</p>".
            "<ol>".
            "<li><a href='".JOINT_SITE_EXEC_DIR."/test/records/musicalb'>musicalb</a></li>".
            "<li><a href='".JOINT_SITE_EXEC_DIR."/test/records/musictracks'>musictracks</a></li>".
            "<li><a href='".JOINT_SITE_EXEC_DIR."/test/records/musictrackstoalb'>musictrackstoalb</a></li>".
            "</ol>".
            "</div></div></div>";
    }
}