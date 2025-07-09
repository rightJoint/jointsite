<?php


namespace Src\Models\Handbook;


use JointApp\JointAppQueryBuilder;
use JointApp\Models\Model_Pdo;

class Model_Handbook_Main extends Model_Pdo
{
    public function countEnv():int
    {
        $qBuilder = new JointAppQueryBuilder();
        $qBuilder->select('count(vName) AS cnt')
            ->from('wpiEnvList');
        $res = $this->pdoQuery($qBuilder->buildQuery());
        $row = $res->fetch(\PDO::FETCH_ASSOC);
        return $row['cnt'];
    }

    public function countHw():int
    {
        $qBuilder = new JointAppQueryBuilder();
        $qBuilder->select('COUNT(paramVal) AS cnt')
            ->from('wpiHwList');
        $res = $this->pdoQuery($qBuilder->buildQuery());
        $row = $res->fetch(\PDO::FETCH_ASSOC);
        return $row['cnt'];
    }

    public function countProcess():int
    {
        $qBuilder = new JointAppQueryBuilder();
        $qBuilder->select('COUNT(pName) AS cnt')
            ->from('wpiProcList');
        $res = $this->pdoQuery($qBuilder->buildQuery());
        $row = $res->fetch(\PDO::FETCH_ASSOC);
        return $row['cnt'];
    }

    public function countServices():int
    {
        $qBuilder = new JointAppQueryBuilder();
        $qBuilder->select('COUNT(pName) AS cnt')
            ->from('wpiProcList');
        $res = $this->pdoQuery($qBuilder->buildQuery());
        $row = $res->fetch(\PDO::FETCH_ASSOC);
        return $row['cnt'];
    }

}