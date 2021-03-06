<?php

namespace App\Presenters;

use App\Model\Article\Article;
use App\Model\Article\ArticleDaoInterface;

final class HomepagePresenter extends FrontPresenter
{
    const ARTICLE_LIMIT = 10;

    /** @var ArticleDaoInterface @inject */
    public $articleDao;

    /** @var Article[] */
    private $articles;

    /** @var int */
    private $articleCount;

    public function actionDefault(): void
    {
        $this->articles = $this->articleDao->findByNewest(self::ARTICLE_LIMIT);
        $this->articleCount = $this->articleDao->getCount();
    }

    public function renderDefault(): void
    {
        $this->getTemplate()->setParameters([
            'articles' => $this->articles,
            'showArchiveButton' => $this->articleCount > count($this->articles),
        ]);
    }
}
