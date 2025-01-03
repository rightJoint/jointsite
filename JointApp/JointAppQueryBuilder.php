<?php


namespace JointApp;


class JointAppQueryBuilder
{
    public string $select = '';
    public string $from = '';
    public string $join = '';
    public string $where = '';
    public string $groupBy = '';
    public string $having = '';
    public string $order = '';
    public string $limit = '';

    public function buildQuery():string
    {
        $query = 'SELECT '.$this->select.' FROM '.$this->from;
        if(!empty($this->join)){
            $query .= ' '.$this->join;
        }
        if(!empty($this->where)){
            $query .= ' WHERE '.$this->where;
        }
        if(!empty($this->groupBy)){
            $query .=' GROUP BY '.$this->groupBy;
        }
        if(!empty($this->having)){
            $query .=' HAVING '.$this->having;
        }
        if(!empty($this->order)){
            $query .=' ORDER BY '.$this->order;
        }
        if(!empty($this->limit)){
            $query.= ' LIMIT '.$this->limit;
        }

        return $query;
    }

    public function select($selectFields):JointAppQueryBuilder
    {
        $this->select = $selectFields;
        return $this;
    }

    public function from($fromTable):JointAppQueryBuilder
    {
        $this->from = $fromTable;
        return $this;
    }

    public function join($joinTables):JointAppQueryBuilder
    {
        $this->join = $joinTables;
        return $this;
    }

    public function where($whereConditions):JointAppQueryBuilder
    {
        $this->where = $whereConditions;
        return $this;
    }

    public function groupBy($groupFields):JointAppQueryBuilder
    {
        $this->groupBy = $groupFields;
        return $this;
    }

    public function having($havingConditions):JointAppQueryBuilder
    {
        $this->having = $havingConditions;
        return $this;
    }

    public function order($sortOrderFields):JointAppQueryBuilder
    {
        $this->order = $sortOrderFields;
        return $this;
    }

    public function limit($limitRecords):JointAppQueryBuilder
    {
        $this->limit = $limitRecords;
        return $this;
    }
}