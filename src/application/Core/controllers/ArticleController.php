<?php 

/**
 * @author Formateur
 * @desc Controlleur par défaut 
 *
 */
class Core_ArticleController extends Zend_Controller_Action
{
	private $blogSvc;
	
	public function init()
	{
		$this->blogSvc = new Core_Service_Blog();
	}
	
	public function indexAction()
	{
		$this->view->articles = $this->blogSvc->fetchLastArticles(2);
		
		$newArticle = new Core_Model_Article();
		$categorie = new Core_Model_Categorie();
		$categorie->setId(1);
		
		$author = new Core_Model_Author();
		$author->setId(1);
		
		$newArticle->setTitle('test save')
		->setContent('sdfgsdfg')
		->setCategorie($categorie)
		->setAuthor($author);
		
		//$this->blogSvc->saveArticle($newArticle);
		
		
	}
	
	public function viewAction()
	{
		$articleId = (int) $this->getRequest()->getParam('id');
		if (0 === $articleId) {
			throw new Zend_Controller_Action_Exception('Article inconnu', 404);
		}
		
		$article = $this->blogSvc->fetchArticleById($articleId);
		if (!$article) {
			throw new Zend_Controller_Action_Exception('Article inconnu', 404);
		}
		
		// Cible le conteneur Zend_Navigation principal
		$nav = Zend_Registry::get('Zend_Navigation');
		// Cible le sous conteneur Article (page)
		$articleNav = $nav->findById('coreArticleIndex');
		// Créée la nouvelle page correspondant à l'article en cours
		$articlePage = Zend_Navigation_Page::factory(
			array(
				'type' => 'mvc',
				'module' => 'Core',
				'controller' => 'article',
				'action' => 'view',
				'params' => array('id' => $articleId),
				'route' => 'coreArticleCategorieview',
				'visible' => false,
				'label' => $article->getTitle()
 			)
		);
		// Injecte la nouvelle page dans le sous conteneur Articles 
		$articleNav->addPage($articlePage);
		
		
		$this->view->article = $article;
	}
	
	public function categoriesAction()
	{
		$this->view->categories = $this->blogSvc->fetchCategories();
	}
	
	
	public function categorieviewAction()
	{
            $categorieId = (int) $this->getRequest()->getParam('id');
            if (0 === $categorieId) {
                    throw new Zend_Controller_Action_Exception('Categorie inconnu', 404);
            }
		
            $categorie = $this->blogSvc->fetchCategorieById($categorieId);
            if (!$categorie) {
                    throw new Zend_Controller_Action_Exception('Categorie inconnu', 404);
            }
            
            $this->view->categorie = $this->blogSvc->fetchCategorieById($categorieId);
            $this->view->articles = $this->blogSvc->fetchArticleByCategorie($categorieId);
	}
	
	public function addarticleAction()
	{
            $form = new Core_Form_Addarticle();
            $form->setAction('')
                 ->setMethod(Zend_Form::METHOD_POST);

            if ($this->getRequest()->isPost()) {
                if ($form->isValid($this->getRequest()->getPost())) {
                    $data = $form->getValues();
                }
            }
            $this->view->form = $form;
	}
}