<?php
class Model_User extends Zend_Db_Table_Row
{
	
	public function getFullName()
	{
		return sprintf('%s %s', $this['first_name'], $this['last_name']);
	}
	
	
	public function getRoleType()
	{
		$modelUsersRoles = new Model_Users_Roles;
		$role = $modelUsersRoles->fetchWithUser($this);
		
		return $role['type'];
	}
}