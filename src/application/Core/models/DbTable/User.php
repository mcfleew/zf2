<?php
/**
 * Description of User
 *
 * @author Fleury Timbe
 */
class Core_Model_DbTable_User extends Zend_Db_Table_Abstract {
    
    protected $_name = 'user';
	
    protected $_primary = Core_Model_Mapper_User::COL_ID;
	
}
