<?php
class Model_Users 
{
    protected $_name = 'users';
	protected $_primary	= 'user_id';
	protected $_rowClass = 'Model_User';
	
	protected $_dependentTables = array('Model_Users_Roles', 'Model_Users_Token');

	/**
	 * fetch user by email
	 * 
	 * @param string $email
	 */
	public function fetchWithEmail($email)
	{
		if (empty($email)) {
			return false;
		}
		
		$select = $this->select();
		$select->where('email = ?', $email);
		return $this->fetchRow($select);
	}
	
	/**
	 * fetch user
	 *
	 * @param int $userId
	 */
	public function fetch($userId)
	{
		$select = $this->select();
		$select->where('user_id = ?', $userId);
		return $this->fetchRow($select);
	}
	

}