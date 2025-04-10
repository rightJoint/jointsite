<?php


namespace Src\Models\Blog;


use JointApp\JointAppQueryBuilder;
use JointApp\Models\Model_Pdo;

class Model_Blog_Arts extends Model_Pdo
{
    public function getBlogArt(string $artRef):array
    {
        $findArts_qry = 'select '.
            'art_id, '.
            'artCat, '.
            'artRef, '.
            'artName_'.$this->langLw.' as artName, '.
            'artMeta_'.$this->langLw.' as artMeta, '.
            'artImg, '.
            'activeFlag, '.
            'indexFlag, '.
            'pubDate, '.
            'refreshDate, '.
            'created_by, '.
            'commentsFlag '.
            'from blogArts '.
            'where artRef = "'.$artRef.'"';

        $res = $this->fetchToArray($findArts_qry);
        if(isset($res[0])){
            return $res[0];
        }

        return [];
    }

    public function getArtTags(string $art_id):array
    {
        $return = [];

        $qBuilder = new JointAppQueryBuilder();

        $qBuilder->select(
            'blogAtrTags.art_id, '.
            'blogAtrTags.tag_id, '.
            'blogTags.tag_'.$this->langLw.' as tagName'
        )
            ->from('blogAtrTags')
            ->join(
                'inner join blogTags on blogAtrTags.tag_id = blogTags.tag_id'
            )
            ->order(
                'blogAtrTags.art_id'
            )
            ->where(
                'blogAtrTags.art_id = "'.$art_id.'"'
            );

        $res = $this->pdoQuery($qBuilder->buildQuery());

        if($res->rowCount()){
            while ($row = $res->fetch(\PDO::FETCH_ASSOC)){
                $return[] = $row['tagName'];
            }
        }
        return $return;
    }

}