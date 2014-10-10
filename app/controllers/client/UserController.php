<?php

class UserController extends BaseController {

	
	
	
	public function login()
	{
		return View::make('client.login');
	}
	
	public function register()
	{
		return View::make('client.register');
	}
	
	public function save_user()
	{
		$rules = array(
		'name'                 => 'required', 						
		'email'                => 'required|email|unique:users', 	
		'password'        	   => 'required',
		'password_confirm' 	   => 'required|same:password' 			
		
		);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) 
		{

			$messages = $validator->messages();

			return Redirect::route('register')
				   ->withErrors($validator);

		} 
		else 
		{
			$saveUser = new User();
			$saveUser->name = Input::get('name');
			$saveUser->email = Input::get('email');
			$saveUser->password = Hash::make(Input::get('password'));
			$saveUser->save();
			return Redirect::route('register');
			
		}
	}
	
	public function user_login()
	{ 
	
		$rules = array(
			'email'    => 'required|email',
			'password' => 'required' 
			);

			$validator = Validator::make(Input::all(), $rules);

			if ($validator->fails()) 
			{
				return Redirect::to('login')
					->withErrors($validator) 
					->withInput(Input::except('password')); 
			} 
			else 
			{
				$userdata = array(
					'email' 	=> Input::get('email'),
					'password' 	=> Input::get('password'),
					
					);
					
					$email 	= Input::get('email');
					$user_type = User::where('email', "=", $email)->get()->first();
				  
				if (Auth::attempt($userdata))
				{
					 $data = Session::all();
					Session::put('admin_email', $email);
					Session::put('user_id', $user_type->id);
					Session::put('user_name', $user_type->name);
				
					if( $user_type->user_type == "1")
					{
						return Redirect::to('admin');
						
					}
					else
					{
						return Redirect::to('index');
					}
				} 
				else 
				{	 	

					return Redirect::to('login');

				}

			}
	
    }
	
	  public function user_logout() {
        Auth::logout();
        Session::flush();
        return Redirect::route('index');
    }
}
