<?php
class LangFiles_En_Views_BlogMain extends LangFiles_En_Views_SiteView
{
    static public function getLangHead():stdClass
    {
        $langHead = parent::getLangHead();

        $langHead->title = 'Blog';
        $langHead->description = 'Blog: articles on different subject, discussions.';

        return $langHead;
    }

    static public function getLangHeader():stdClass
    {
        $langHeader = parent::getLangHeader();

        $langHeader->h1 = 'Blog - find article';

        return $langHeader;
    }

    static public function getLangPageContent():\stdClass
    {
        $langPageContent = parent::getLangPageContent();

        $langBlogFilter = new \stdClass();
        $langBlogFilter->labelCats = 'blog-filter-cat';
        $langBlogFilter->artNamePh = 'search art name';
        $langBlogFilter->findBtn = 'find';

        $langPageContent->langBlogFilter = $langBlogFilter;

        $langArtList = new \stdClass();
        $langArtList->pubText = 'pubDate date';
        $langArtList->refreshText = 'refresh date';
        $langArtList->refTitle = 'Read article on';
        $langArtList->refText = 'Learn more';

        $langPageContent->langArtList = $langArtList;

        $langSortBlock = new \stdClass();
        $langSortBlock->labelSortField = 'Sort field';
        $langSortBlock->optArtName = 'artName';
        $langSortBlock->optPubDate = 'pubDate';
        $langSortBlock->optRefreshDate = 'refreshDate';
        $langSortBlock->labelSortOrderBy = 'Order by';
        $langSortBlock->optOrderAsc = 'ASC';
        $langSortBlock->optOrderDesc = 'DESC';

        $langPageContent->langSortBlock = $langSortBlock;

        $langViewOpt = new \stdClass();
        $langViewOpt->labelOnPage = 'Put on page';
        $langViewOpt->labelInRow = 'In row';

        $langPageContent->langViewOpt = $langViewOpt;

        $langPageContent->foundLabel = 'Found';

        return $langPageContent;
    }
}
