<?php


namespace Src\Views\Blog\IT;


trait SkillsTableTrait
{
    public static function skillsTable(\stdClass $skillsTable):string
    {
        return
        '<table class="skills">'.
        '<tr>'.
        '<td class="skill skill-cap">'.$skillsTable->tCap->skill.'</td>'.
        '<td class="option skill-cap">'.$skillsTable->tCap->descr.'</td>'.
        '<td class="level skill-cap">'.$skillsTable->tCap->level.'</td>'.
        '</tr>'.
        self::skillsPhp($skillsTable->php).
        self::skillsHtml($skillsTable->html).
        self::skillsJavaScript($skillsTable->js).
        self::skillsDatabase($skillsTable->relDb).
        self::skillsOtherDb($skillsTable->nRelDb).
        self::skillsShell($skillsTable->shell).
        self::skillsVsc($skillsTable->vcs).
        self::skillsCache($skillsTable->hLoad).
        self::skillsDocker($skillsTable->docker).
        self::skillsOwasp($skillsTable->owasp).
        self::skillsTest($skillsTable->tests).
        self::skillsQueue($skillsTable->queue).
        self::skillsMethods($skillsTable->methods).
        self::skillsOther($skillsTable->other).
        self::skillsHb($skillsTable->hb).
        '</table>';
    }

    public static function skillsLegendTable(\stdClass $tLeg):string
    {
        return '<div class="s-legend">'.
            '<table class="skill-legend">'.
            '<tr><td class="c-level">'.$tLeg->trCap->level.'</td><td class="c-descr">'.$tLeg->trCap->detail.'</td></tr>'.
            '<tr>'.
            '<td class="pretty-good">'.$tLeg->tr1->level.'</td>'.
            '<td class="l-descr">'.$tLeg->tr1->detail.'</td>'.
            '</tr>'.
            '<tr>'.
            '<td class="competitive">'.$tLeg->tr2->level.'</td>'.
            '<td class="l-descr">'.$tLeg->tr2->detail.'</td>'.
            '</tr>'.
            '<tr>'.
            '<td class="junior">'.$tLeg->tr3->level.'</td>'.
            '<td class="l-descr">'.$tLeg->tr3->detail.'</td>'.
            '</tr>'.
            '<tr>'.
            '<td class="surficial">'.$tLeg->tr4->level.'</td>'.
            '<td class="l-descr">'.$tLeg->tr4->detail.'</td>'.
            '</tr>'.
            '</table>'.
            '</div>';
    }

    public static function skillsPhp(\stdClass $php):string
    {
        return '<td rowspan="15" class="skill">php</td>'.
            '<td class="option pretty-good">'.$php->c2->c21.'</td>'.
            '<td class="level">'.$php->c3->c31.'</td>'.
            '</tr>'.
            '<tr>'.
            '<td class="option competitive">'.$php->c2->c22.'</td>'.
            '<td class="level">'.$php->c3->c32.'</td>'.
            '</tr>'.
            '<tr>'.
            '<td class="option competitive">'.$php->c2->c23.'</td>'.
            '<td class="level">'.$php->c3->c33.'</td>'.
            '</tr>'.
            '<tr>'.
            '<td class="option competitive">'.$php->c2->c24.'</td>'.
            '<td class="level">'.$php->c3->c34.'</td>'.
            '</tr>'.
            '<tr>'.
            '<tr>'.
            '<td class="option competitive">'.$php->c2->c25.'</td>'.
            '<td class="level">'.$php->c3->c35.'</td>'.
            '</tr>'.
            '<tr>'.
            '<tr>'.
            '<td class="option competitive">'.$php->c2->c26.'</td>'.
            '<td class="level">'.$php->c3->c36.'</td>'.
            '</tr>'.
            '<tr>'.
            '<td class="option competitive">'.$php->c2->c27.'</td>'.
            '<td class="level">'.$php->c3->c37.'</td>'.
            '</tr>'.
            '<tr>'.
            '<td class="option junior">'.$php->c2->c28.'</td>'.
            '<td class="level">'.$php->c3->c38.'</td>'.
            '</tr>'.
            '<tr>'.
            '<td class="option competitive">'.$php->c2->c29.'</td>'.
            '<td class="level">'.$php->c3->c39.'</td>'.
            '</tr>'.
            '<tr>'.
            '<td class="option competitive">'.$php->c2->c210.'</td>'.
            '<td class="level">'.$php->c3->c310.'</td>'.
            '</tr>'.
            '<tr>'.
            '<td class="option competitive">'.$php->c2->c211.'</td>'.
            '<td class="level">'.$php->c3->c311.'</td>'.
            '</tr>'.
            '<tr>'.
            '<td class="option competitive">'.$php->c2->c212.'</td>'.
            '<td class="level">'.$php->c3->c312.'</td>'.
            '</tr>'.
            '<tr>'.
            '<td class="option competitive">'.$php->c2->c213.'</td>'.
            '<td class="level">'.$php->c3->c313.'</td>'.
            '</tr>';
    }

    public static function skillsHtml(\stdClass $html):string
    {
        return '<tr>'.
            '<td rowspan="2" class="skill">html, css</td>'.
            '<td class="option competitive">'.$html->c2->c21.'</td>'.
            '<td class="level">'.$html->c3->c31.'</td>'.
            '</tr>'.
            '<tr>'.
            '<td class="option competitive">'.$html->c2->c22.'</td>'.
            '<td class="level">'.$html->c3->c32.'</td>'.
            '</tr>';
    }

    public static function skillsJavaScript(\stdClass $js):string
    {
        return '<tr>'.
            '<td rowspan="6" class="skill">JavaScript</td>'.
            '<td class="option competitive">'.$js->c2->c21.'</td>'.
            '<td class="level">'.$js->c3->c31.'</td>'.
            '</tr>'.
            '<tr>'.
            '<td class="option competitive">'.$js->c2->c22.'</td>'.
            '<td class="level">'.$js->c3->c32.'</td>'.
            '</tr>'.
            '<tr>'.
            '<td class="option surficial">'.$js->c2->c23.'</td>'.
            '<td class="level">'.$js->c3->c33.'</td>'.
            '</tr>'.
            '<tr>'.
            '<td class="option surficial">'.$js->c2->c24.'</td>'.
            '<td class="level">'.$js->c3->c34.'</td>'.
            '</tr>'.
            '<tr>'.
            '<td class="option surficial">'.$js->c2->c25.'</td>'.
            '<td class="level">'.$js->c3->c35.'</td>'.
            '</tr>'.
            '<tr>'.
            '<td class="option surficial">'.$js->c2->c26.'</td>'.
            '<td class="level">'.$js->c3->c36.'</td>'.
            '</tr>';
    }

    public static function skillsDatabase(\stdClass $relDb):string
    {
        return '<tr>'.
            '<td rowspan="11" class="skill">'.$relDb->c1.'</td>'.
            '<td class="option competitive">'.$relDb->c2->c21.'</td>'.
            '<td class="level">'.$relDb->c3->c31.'</td>'.
            '</tr>'.
            '<tr>'.
            '<td class="option competitive">'.$relDb->c2->c22.'</td>'.
            '<td class="level">'.$relDb->c3->c32.'</td>'.
            '</tr>'.
            '<tr>'.
            '<td class="option surficial">'.$relDb->c2->c23.'</td>'.
            '<td class="level">'.$relDb->c3->c33.'</td>'.
            '</tr>'.
            '<tr>'.
            '<td class="option pretty-good">'.$relDb->c2->c24.'</td>'.
            '<td class="level">'.$relDb->c3->c34.'</td>'.
            '</tr>'.
            '<tr>'.
            '<td class="option competitive">'.$relDb->c2->c25.'</td>'.
            '<td class="level">'.$relDb->c3->c35.'</td>'.
            '</tr>'.
            '<tr>'.
            '<td class="option competitive">'.$relDb->c2->c26.'</td>'.
            '<td class="level">'.$relDb->c3->c36.'</td>'.
            '</tr>'.
            '<tr>'.
            '<td class="option surficial">'.$relDb->c2->c27.'</td>'.
            '<td class="level">'.$relDb->c3->c37.'</td>'.
            '</tr>'.
            '<tr>'.
            '<td class="option competitive">'.$relDb->c2->c28.'</td>'.
            '<td class="level">'.$relDb->c3->c38.'</td>'.
            '</tr>'.
            '<tr>'.
            '<td class="option junior">'.$relDb->c2->c29.'</td>'.
            '<td class="level">'.$relDb->c3->c39.'</td>'.
            '</tr>'.
            '<tr>'.
            '<td class="option surficial">'.$relDb->c2->c210.'</td>'.
            '<td class="level">'.$relDb->c3->c310.'</td>'.
            '</tr>'.
            '<tr>'.
            '<td class="option surficial">'.$relDb->c2->c211.'</td>'.
            '<td class="level">'.$relDb->c3->c311.'</td>'.
            '</tr>';
    }

    public static function skillsOtherDb(\stdClass $nRelDb):string
    {
        return '<tr>'.
            '<td rowspan="1" class="skill">'.$nRelDb->c1.'</td>'.
            '<td class="option surficial">'.$nRelDb->c2->c21.'</td>'.
            '<td class="level">'.$nRelDb->c3->c31.'</td>'.
            '</tr>';
    }

    public static function skillsShell(\stdClass $shell):string
    {
        return '<tr>'.
            '<td rowspan="2" class="skill">'.$shell->c1.'</td>'.
            '<td class="option competitive">'.$shell->c2->c21.'</td>'.
            '<td class="level">'.$shell->c3->c31.'</td>'.
            '</tr>'.
            '<tr>'.
            '<td class="option competitive">'.$shell->c2->c22.'</td>'.
            '<td class="level">'.$shell->c3->c32.'</td>'.
            '</tr>';
    }

    public static function skillsVsc(\stdClass $vsc):string
    {
        return '<tr>'.
            '<td rowspan="2" class="skill">'.$vsc->c1.'</td>'.
            '<td class="option competitive">'.$vsc->c2->c21.'</td>'.
            '<td class="level">'.$vsc->c3->c31.'</td>'.
            '</tr>'.
            '<tr>'.
            '<td class="option competitive">'.$vsc->c2->c22.'</td>'.
            '<td class="level">'.$vsc->c3->c32.'</td>'.
            '</tr>';
    }

    public static function skillsCache(\stdClass $hLoad):string
    {
        return '<tr>'.
            '<td rowspan="2" class="skill">'.$hLoad->c1.'</td>'.
            '<td class="option junior">'.$hLoad->c2->c21.'</td>'.
            '<td class="level">'.$hLoad->c3->c31.'</td>'.
            '</tr>'.
            '<tr>'.
            '<td class="option junior">'.$hLoad->c2->c22.'</td>'.
            '<td class="level">'.$hLoad->c3->c32.'</td>'.
            '</tr>';
    }

    public static function skillsDocker(\stdClass $docker):string
    {
        return '<tr>'.
            '<td rowspan="2" class="skill">'.$docker->c1.'</td>'.
            '<td class="option competitive">'.$docker->c2->c21.'</td>'.
            '<td class="level">'.$docker->c3->c31.'</td>'.
            '</tr>'.
            '<tr>'.
            '<td class="option junior">'.$docker->c2->c22.'</td>'.
            '<td class="level">'.$docker->c3->c32.'</td>'.
            '</tr>';
    }

    public static function skillsOwasp(\stdClass $owasp):string
    {
        return '<tr>'.
            '<td rowspan="1" class="skill">OWASP</td>'.
            '<td class="option competitive">'.$owasp->c2.'</td>'.
            '<td class="level">'.$owasp->c3.'</td>'.
            '</tr>';
    }

    public static function skillsTest(\stdClass $test):string
    {
        return '<tr>'.
            '<td rowspan="3" class="skill">'.$test->c1.'</td>'.
            '<td class="option competitive">'.$test->c2->c21.'</td>'.
            '<td class="level">'.$test->c3->c31.'</td>'.
            '</tr>'.
            '<tr>'.
            '<td class="option junior">'.$test->c2->c22.'</td>'.
            '<td class="level">'.$test->c3->c32.'</td>'.
            '</tr>'.
            '<tr>'.
            '<td class="option surficial">'.$test->c2->c23.'</td>'.
            '<td class="level">'.$test->c3->c33.'</td>'.
            '</tr>';
    }

    public static function skillsQueue(\stdClass $queue):string
    {
        return '<tr>'.
            '<td rowspan="2" class="skill">'.$queue->c1.'</td>'.
            '<td class="option surficial">Kafka</td>'.
            '<td class="level" rowspan="2">'.$queue->c2.'</td>'.
            '</tr>'.
            '<tr>'.
            '<td class="option surficial">Rabbit Mq</td>'.
            '</tr>';
    }

    public static function skillsMethods(\stdClass $methods):string
    {
        return '<tr>'.
            '<td rowspan="5" class="skill">'.$methods->c1.'</td>'.
            '<td class="option competitive">Scrum</td>'.
            '<td class="level">'.$methods->c3->c31.'</td>'.
            '</tr>'.
            '<tr>'.
            '<td class="option surficial" >Kanban</td>'.
            '<td class="level" rowspan="3">'.$methods->c3->c32.'</td>'.
            '</tr>'.
            '<tr>'.
            '<td class="option junior">Aglie</td>'.
            '</tr>'.
            '<tr>'.
            '<td class="option surficial">Lean</td>'.
            '</tr>'.
            '<tr>'.
            '<td class="option competitive">TDD</td>'.
            '<td class="level">'.$methods->c3->c33.'</td>'.
            '</tr>';
    }

    public static function skillsHb(\stdClass $hb):string
    {
        return '<tr>'.
            '<td rowspan="1" class="skill">'.$hb->c1.'</td>'.
            '<td class="option competitive">Swagger, Confluence, Jira</td>'.
            '<td class="level">'.$hb->c3.'</td>'.
            '</tr>';
    }

    public static function skillsOther(\stdClass $other):string
    {
        return '<tr>'.
            '<td rowspan="5" class="skill">'.$other->c1.'</td>'.
            '<td class="option competitive">Ansible</td>'.
            '<td class="level">'.$other->c3->c31.'</td>'.
            '</tr>'.
            '<tr>'.
            '<td class="option competitive">Elasticsearch</td>'.
            '<td class="level">'.$other->c3->c32.'</td>'.
            '</tr>'.
            '<tr>'.
            '<td class="option surficial">Web-Sockets</td>'.
            '<td class="level">'.$other->c3->c33.'</td>'.
            '</tr>'.
            '<tr>'.
            '<td class="option surficial">TelegramBot</td>'.
            '<td class="level" rowspan="2">'.$other->c3->c34.'</td>'.
            '</tr>'.
            '<tr>'.
            '<td class="option surficial">BlockChain</td>'.
            '</tr>';
    }
}