<?php
/**
 * Description of User
 *
 * @author Fleury Timbe
 */
class Core_Model_User {
    
    /**
     * @var id
     */
    private $id;
    /**
     * @var login
     */
    private $login;

    /**
     * @var password
     */
    private $password;
    
    public function getId() {
        return $this->id;
    }

    public function getLogin() {
        return $this->login;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getRoleId() {
        return strtok($this->roleId, "@");
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setLogin($login) {
        $this->login = $login;
        return $this;
    }

    public function setPassword($password) {
        $this->password = $password;
        return $this;
    }


}
