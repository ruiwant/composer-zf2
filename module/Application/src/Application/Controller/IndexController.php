<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Doctrine\Common\Util\Debug;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        $objectManager = $this->getEntityManager();
//         $user = new \Application\Entity\User();
//         $user->setName('engineer');
//         $objectManager->persist($user);
//         $objectManager->flush();
        
        $productIds = array(1,2,3);
        
        $reporter = $objectManager->find("Application\Entity\User", 2);
        $engineer = $objectManager->find("Application\Entity\User", 3);
        if (!$reporter || !$engineer) {
            echo "No reporter and/or engineer found for the input.\n";
            exit(1);
        }
        
        
        
        $bug = new \Application\Entity\Bug();
        $bug->setDescription("Something does not work!");
        $bug->setCreated(new \DateTime("now"));
        $bug->setStatus("OPEN");
        
        foreach ($productIds as $productId) {
            $product = $objectManager->find("Application\Entity\Product", $productId);
            $bug->assignToProduct($product);
        }
        
        $bug->setReporter($reporter);
        $bug->setEngineer($engineer);
        
        $objectManager->persist($bug);
        $objectManager->flush();
        
        echo "Your new Bug Id: ".$bug->getId()."\n";
        
        
//         $product = new \Application\Entity\Product();
//         $product->setName('test');
//         $objectManager->persist($product);
//         $objectManager->flush();
//         var_dump($product);
//         Debug::dump($product);
        
//         $objectManager->clear();
//         $objectManager->close();
        return new ViewModel();
    }
    
    
    /**
     * 获取Doctrine ORM EntityManager
     * @return Ambigous <object, multitype:, \Doctrine\ORM\EntityManager>
     */
    protected function getEntityManager()
    {
        $objectManager = $this
        ->getServiceLocator()
        ->get('Doctrine\ORM\EntityManager');
        return $objectManager;
    }
}

