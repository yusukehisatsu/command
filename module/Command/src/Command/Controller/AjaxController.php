<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Command\Controller;

use Zend\Mvc\Controller\AbstractActionController;
//use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use Command\Model\Select;

class AjaxController extends AbstractActionController
{
    public function indexAction()
    {
        //パラメータ取得
        $command = $this->params()->fromQuery('command');

        //スペースを_に置換
        $command = preg_replace("/( |　)+/u", "_", $command );

        //検索処理
        $select = new Select();
        $rowset = $select->selectList($command);

        //JSONで返却
        $jsonModel = new JsonModel($rowset);
        $jsonModel->setTerminal(true);
        return $jsonModel;
    }
}
