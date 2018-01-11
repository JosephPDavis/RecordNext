<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Http\Client;

class SearchController extends AppController
{

    public function beforeFilter(Event $event)
    {
	$this->viewBuilder()->setLayout('dashboard');         
 	parent::beforeFilter($event);
        //$this->Auth->allow('cars');
    }

    public function cars()
    {
	$this->viewBuilder()->setLayout('dashboard');      	
	$this->loadModel('Users');
	$page = $this->request->query('page');
	$rows = $this->request->query('rows');
	$start = (($page - 1) * $rows);
	    
	$http = new Client();
	$response = $http->post("https://api.tailpi.pe/search/cars/rows/$rows/start/$start");
	$data = $response->json;
	$cars = isset($data['docs'])?$data['docs']:array();
	///$TotalDatas = count($data);
	//$StartFrom = $start;
	///$DisplayLimit = $rows;
	//$CurrentPage = $page;


	$this->set(compact('data', 'page', 'rows', 'cars'));
	
    }

}
