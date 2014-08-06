<?php 

class Core_Service_Blog
{
	
	public function fetchCategories($asArray = false)
	{
		$mapper = new Core_Model_Mapper_Categorie();
                $articles = $mapper->fetchAll();
                if(false === $asArray) {
                    return $articles;
                } else {
                    $articleArray = array();
                    foreach ($articles as $article) {
                        $articleArray[$article->getId()] = $article->getNom();
                    }
                    return $articleArray;
                }
	}
	
	public function fetchAuteurs($asArray = false)
	{
		$mapper = new Core_Model_Mapper_Author();
                $auteurs = $mapper->fetchAll();
                if(false === $asArray) {
                    return $auteurs;
                } else {
                    $auteurArray = array();
                    foreach ($auteurs as $auteur) {
                        $auteurArray[$auteur->getId()] = $auteur->getName();
                    }
                    return $auteurArray;
                }
	}
	
	public function fetchCategorieById($categorieId)
	{
		if (0 === (int) $categorieId) {
			throw new InvalidArgumentException('categorieId doit être un entier supérieur à 1');
		}
                
		$mapper = new Core_Model_Mapper_Categorie();
                return $mapper->find($categorieId);
	}
        
	/**
	 * Fetches last articles (ordered by date)
	 * @param number $count number of fetched articles
	 */
	public function fetchLastArticles($count = 5)
	{
		$count = (int) $count;
		
		if (0 === $count) {
			throw new InvalidArgumentException('count doit être un entier supérieur à 1');
		}

		$mapper = new Core_Model_Mapper_Article;
		$articles = $mapper->fetchAll(null,'article_id DESC', $count);

		return $articles;
		
	}
	
	/**
	 * @param number $articleId
	 * @throws InvalidArgumentException
	 * @return Core_Model_Article
	 */
	public function fetchArticleById($articleId)
	{
		if (0 === (int) $articleId) {
			throw new InvalidArgumentException('articleId doit être un entier supérieur à 1');
		}
		
		$mapper = new Core_Model_Mapper_Article;
		$article = $mapper->find($articleId);
		
		return $article;
		
	}
	
	/**
	 * @param number $articleId
	 * @throws InvalidArgumentException
	 * @return Core_Model_Article
	 */
	public function fetchArticleByCategorie($categoryId)
	{
		if (0 === (int) $categoryId) {
			throw new InvalidArgumentException('categoryId doit être un entier supérieur à 1');
		}
		
		$mapper = new Core_Model_Mapper_Article;
                $where = array(Core_Model_Mapper_Article::COL_CATEGORIE_ID . ' = ?' => $categoryId);
		$articles = $mapper->fetchAll($where, 'article_id DESC');
		
		return $articles;
		
	}
	
	public function saveArticle(Core_Model_Article $article)
	{
		$mapper = new Core_Model_Mapper_Article;
		$mapper->save($article);
	}
}