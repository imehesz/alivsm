<?php

class SiteController extends Controller
{
	public $content_left = '';
	public $content_right = '';
	public $intro;

	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->content_left = $this->renderPartial( '_ali', null, true );
		$this->content_right= $this->renderPartial( '_im', null, true );
		$this->intro = <<<ENG
This all comes down to this. As you probably all know by now, Alison and I are <a href="http://en.wikipedia.org/wiki/Infant" target="blank">having a baby</a>. As probably most of you know, I'm also having a <a href="http://en.wikipedia.org/wiki/Kidney_stone" target="_blank">kidney stone</a>. In fact, I'm having 2 kidney stones. And this is where you come into the picture. We would like you to vote on who is getting the "<i>stuff</i>" out first. The number indicates the days since we figured it out.<br />See the stats on the bottom and <strong>V O T E</strong>! 
ENG;
		$this->render(
			'index', 
			array( 
				'content_left' 	=> $this->content_left, 
				'content_right' => $this->content_right,
				'intro'			=> $this->intro,
			) 
		);
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$headers="From: {$model->email}\r\nReply-To: {$model->email}";
				mail(Yii::app()->params['adminEmail'],$model->subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}

	public function actionVote()
	{
		$newvote = new Vote;

		switch( $_GET['param'] )
		{
			case 'a':
						$newvote->vote = 'a';
						$newvote->save();
						break;

			case 'm':	$newvote->vote = 'm';
						$newvote->save();
						break; 
						
		}
		die( 'success' );
	}
}
