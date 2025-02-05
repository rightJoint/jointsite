<?php
class LangFiles_Ru_Views_BlogMain extends LangFiles_Ru_Views_SiteView
{
    static public function getLangHead():stdClass
    {
        $langHead = parent::getLangHead();

        $langHead->title = 'Блог';
        $langHead->description = 'Блог: статьи на различные темы, обсуждение.';

        return $langHead;
    }

    static public function getLangHeader():stdClass
    {
        $langHeader = parent::getLangHeader();

        $langHeader->h1 = 'Блог - поиск статей';

        return $langHeader;
    }

    static public function getLangPageContent():\stdClass
    {
        $langPageContent = parent::getLangPageContent();

        $langBlogFilter = new \stdClass();
        $langBlogFilter->labelCats = 'Искать в категории';
        $langBlogFilter->artNamePh = 'по названию';
        $langBlogFilter->findBtn = 'Найти';

        $langPageContent->langBlogFilter = $langBlogFilter;

        $langArtList = new \stdClass();
        $langArtList->pubText = 'Опубликовано';
        $langArtList->refreshText = 'Обновлено';
        $langArtList->refTitle = 'Читать статью на';
        $langArtList->refText = 'Подробнее';

        $langPageContent->langArtList = $langArtList;

        $langSortBlock = new \stdClass();
        $langSortBlock->labelSortField = 'Сортировка';
        $langSortBlock->optArtName = 'название';
        $langSortBlock->optPubDate = 'дт.публикации';
        $langSortBlock->optRefreshDate = 'дт.обновления';
        $langSortBlock->labelSortOrderBy = 'По';
        $langSortBlock->optOrderAsc = 'Возрастанию';
        $langSortBlock->optOrderDesc = 'Убыванию';

        $langPageContent->langSortBlock = $langSortBlock;

        $langViewOpt = new \stdClass();
        $langViewOpt->labelOnPage = 'Показывать по';
        $langViewOpt->labelInRow = 'Столбцы';

        $langPageContent->langViewOpt = $langViewOpt;

        $langPageContent->foundLabel = 'Найдено';

        $langPg = new \stdClass();
        $langPg->next = 'след.';
        $langPg->pre = 'пред.';

        $langPageContent->langPg = $langPg;

        return $langPageContent;
    }
}
