<?php
namespace BlueFission\Framework;

use BlueFission\Services\Service;
use BlueFission\Services\Model\BaseModel;

class BaseController extends Service {

	protected function response( $data )
	{
		$response = [];
		if ( $data instanceof BaseModel ) {
			$response = [
				'id' => $data->id(),
				'children' => $data->children(),
				'list' => $data->contents(),
				'data' => $data->data(),
				'status'=> $data->status(),
			];
			/*
			if ( env('DEBUG') && method_exists ( $this->_dataObject, 'query' )) {
				$response['info'] = $this->_dataObject->query();
			}
			*/
		} else {
			return response($data);
		}
		return response($response);
	}
}