<?php

class ArticleManager extends Model{


    public function getArticles(){
        return $this->getAll('articles', 'Article');//table et obj
    }
}