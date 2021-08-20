<?php 
	namespace App\Mail;

	use Illuminate\Contracts\Mail\Mailer;
	use App\Models\User;

	/**
	 * 
	 */
	class AppMailer
	{
		protected $from = 'info@persianbit.net';
		protected $to;
		protected $view;
		protected $data;
		protected $mailer;
		public function __construct(Mailer $mailer)
		{
			$this->mailer = $mailer;
		}

		public function sendEmailConfirmationTo(User $user){
			$this->to = $user->email;
			$this->view = 'emails.confirm';
			$this->data = compact('user');

			return $this->deliver();
		}

		public function deliver(){
			$this->mailer->send($this->view, $this->data, function($message){
				$message->from($this->from, 'persianbit');
				$message->to($this->to)->subject('Please confirm your email');
			});
		}
	}
?>