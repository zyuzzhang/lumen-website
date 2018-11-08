<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Newsletter;
use Illuminate\Http\Request;
use App\Enewsletter;

class ExampleController extends Controller {
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		//
	}
	
	//
	public function test(Request $request) {
		$info = $request->post ();
		Log::info ( $info, [ 
				'mailchimp' 
		] );
		
		$listId = $info ['data'] ['list_id'] ?? '';
		
		if (config ( 'newsletter.lists.thinkhotels.id' ) != $listId && config ( 'newsletter.lists.hicom.id' ) != $listId) {
			
			Log::warning ( 'request data error ,may be attacked', [ 'save-mailchimp-info' ] );
			return;
		}
		$data = [ ];
		
		if ($info ['type'] == 'upemail') {
			$model = $this->findModel ( $info ['data'] ['old_email'] );
			$model->email = $info ['data'] ['new_email'];
			$result = $model->save ();
			if (! $result) {
				Log::error ( 'the type of upmail save error' );
			}
			return;
		}
		if($info['type'] == 'cleaned'){
			Enewsletter::where ( [ 'email' => $info['data']['email'] ] )->delete();
			return;
		}
		$model = $this->findModel ( $info ['data'] ['email'] );
		if ($info ['type'] == 'subscribe') {
			$model->IsUnsubscribe = 0;
		}
		if ($info ['type'] == 'unsubscribe') {
			$model->IsUnsubscribe = 1;
		}
		$model->firstname = $info ['data'] ['merges'] ['FNAME'];
		$model->lastname = $info ['data'] ['merges'] ['LNAME'];
		$model->email = $info ['data'] ['email'];
		$model->confirmemail = $info ['data'] ['email'];
		$model->addDateTime = $info ['fired_at'];
		$model->site_id = $info ['data'] ['merges'] ['SITE_ID'];
		$result = $model->save ();
		if (! $result) {
			Log::error ( 'the type of ' . $info ['type'] . ' save error' );
		}
		return;
	}
	protected function findModel(string $email) {
		$model = Enewsletter::where ( [ 'email' => $email ] )->first ();
		if ($model) {
			return $model;
		}
		return new Enewsletter ();
	}
}
