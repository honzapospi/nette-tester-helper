<?php

/**
 * Copyright (c) Jan Pospisil (http://www.jan-pospisil.cz)
 */

namespace JP\Tester;
use Nette\Application\Request;
use Nette\SmartObject;

/**
 * RequestBuilder
 * @author Jan Pospisil
 */

class RequestBuilder {
	use SmartObject;

	const GET = 'GET';
	const POST = 'POST';

	private $method = 'GET';
	private $params = array();
	private $post = array();
	private $files = array();
	private $flags = array('secured' => FALSE);
	private $action = 'default';

	public function createRequest($name = NULL){
		return new Request($name, $this->method, $this->getParams(), $this->post, $this->files, $this->flags);
	}

	public function setAction($action){
		$this->action = $action;
		return $this;
	}

	public function setParams(array $params){
		$this->params = $params;
		return $this;
	}

	public function setPost(array $post){
		$this->post = $post;
		$this->method = self::POST;
		return $this;
	}

	public function setFiles(array $files){
		$this->files = $files;
		return $this;
	}

	public function setFlags(array $flags){
		$this->flags = $flags;
	}

	private function getParams(){
		$params = $this->params;
		$params['action'] = $this->action;
		if(!array_key_exists('id', $params))
			$params['id'] = NULL;
		return $params;
	}

}
