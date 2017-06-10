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

class AutoController extends AbstractActionController
{
    public function indexAction()
    {
        //パラメータ取得
        $command = $this->params()->fromQuery('command');
        $checks = $this->params()->fromQuery('checks');

        //スペースを_に置換
        $command = preg_replace("/( |　)+/u", "_", $command );

        //検索処理
        $select = new Select();
        $rowset = $select->selectCommand($command,$checks);

        $rows = $rowset->toArray();
        $result = array();
        foreach ($rows as $row) {
            array_push($result , $row['command_name']);
        }

        //JSONで返却
        $jsonModel = new JsonModel($result);
        $jsonModel->setTerminal(true);
        return $jsonModel;
    }
}
