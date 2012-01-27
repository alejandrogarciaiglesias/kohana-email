<?php defined('SYSPATH') or die('No direct script access.');

class Model_Emailqueue extends ORM {

  protected $_table_name = 'email_queue';
  protected $_created_column = array(
		'column' => 'created_at',
		'format' => 'U'
	);

  public function get_emails($label = NULL, $amount = NULL)
  {
    if ($label)
    {
      $this->where('label', '=', $label);
    }
    if ($amount)
    {
      $this->limit($amount);
    }
    return $this
      ->order_by('created_at', 'asc')
      ->find_all();
  }
}