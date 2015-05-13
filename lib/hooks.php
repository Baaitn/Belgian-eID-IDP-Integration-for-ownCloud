<?php

class hooks {

    static public function test($params) {
        $user = OCP\User::getUser();
        $path = $params['path'];
        OCP\Util::writeLog('test', 'Username: ' . $user . ', Path: ' . $path, OCP\Util::INFO);
    }
    //User <USER ID> attempted to log into ownCloud from IP address: <A.B.C.D>
    //User <USER ID> logged into ownCloud from IP address: <A.B.C.D>
    //User <USER ID> logged out of ownCloud
    //Read \"<PATH OF FILE>\" by user <USER ID>, owner: <FILE OWNER> //<< view or download
    //Create \“<PATH OF FILE>” by user <USER ID>, owner: <OWNER> //<< create or upload
    //Write \“<PATH OF FILE>” by user <UESR ID>, owner: <OWNER> //<< modifiy
    //Delete \"<PATH OF FILE>\" by user <USER ID>, owner: <OWNER> //<< deleted
    //User <Owner> shared \"\/<FILE>\" with the user <SHARE WITH>, permissions: <PERMISSIONS>
    //User <OWNER> shared \"\/<FILE>\" with a public link, token=6a0fb2e1087457b0132a418e78d282a9, permissions: <PERMISSION>
    //User <OWNER> updated the permissions for \"\/<FILE>\" for , permissions: <PERMISSIONS>
    
    //Usermanagement 
    static public function pre_login($params) {
        $user = $params['uid'];
        $pass = $params['password'];
        OCP\Util::writeLog('pre_login', 'Username: ' . $user . ', Password: ' . $pass . ', IP: ' . $_SERVER['REMOTE_ADDR'], OCP\Util::INFO);
    }
    static public function post_login($params) {
        $user = $params['uid']; //OCP\User::getUser();
        $pass = $params['password'];
        OCP\Util::writeLog('post_login', 'Username: ' . $user . ', Password: ' . $pass, OCP\Util::INFO);
    }
    static public function logout($params) {
        $user = OCP\User::getUser();
        OCP\Util::writeLog('logout', 'Username: ' . $user, OCP\Util::INFO);
    }
    
    //Filesystem
    static public function touch($params) {
        $user = OCP\User::getUser();
        $path = $params['path'];
        OCP\Util::writeLog('touch', 'Username: ' . $user . ', Path: ' . $path, OCP\Util::INFO);
    }
    static public function post_touch($params) {
        $user = OCP\User::getUser();
        $path = $params['path'];
        OCP\Util::writeLog('post_touch', 'Username: ' . $user . ', Path: ' . $path, OCP\Util::INFO);
    }
    static public function create($params) {
        $user = OCP\User::getUser();
        $path = $params['path'];
        OCP\Util::writeLog('create', 'Username: ' . $user . ', Path: ' . $path, OCP\Util::INFO);
    }
    static public function post_create($params) {
        $user = OCP\User::getUser();
        $path = $params['path'];
        OCP\Util::writeLog('post_create', 'Username: ' . $user . ', Path: ' . $path, OCP\Util::INFO);
    }
    static public function read($params) {
	$user = OCP\User::getUser();
        $path = $params['path'];
        OCP\Util::writeLog('read', 'Username: ' . $user . ', Path: ' . $path, OCP\Util::INFO);
    }
    static public function write($params) {
        $user = OCP\User::getUser();
        $path = $params['path'];
        OCP\Util::writeLog('write', 'Username: ' . $user . ', Path: ' . $path, OCP\Util::INFO);
    }
    static public function post_write($params) {
        $user = OCP\User::getUser();
        $path = $params['path'];
        OCP\Util::writeLog('post_write', 'Username: ' . $user . ', Path: ' . $path, OCP\Util::INFO);
    }
    static public function delete($params) {
        $user = OCP\User::getUser();
        $path = $params['path'];
        OCP\Util::writeLog('delete', 'Username: ' . $user . ', Path: ' . $path, OCP\Util::INFO);
    }
    static public function post_delete($params) {
        $user = OCP\User::getUser();
        $path = $params['path'];
        OCP\Util::writeLog('post_delete', 'Username: ' . $user . ', Path: ' . $path, OCP\Util::INFO);
    }
    static public function rename($params) {
        $user = OCP\User::getUser();
        $oldpath = $params['oldpath'];
        $newpath = $params['newpath'];
        OCP\Util::writeLog('rename', 'Username: ' . $user . ', Path (Old): ' . $oldpath . ', Path (New): ' . $newpath, OCP\Util::INFO);
    }
    static public function post_rename($params) {
        $user = OCP\User::getUser();
        $oldpath = $params['oldpath'];
        $newpath = $params['newpath'];
        OCP\Util::writeLog('post_rename', 'Username: ' . $user . ', Path (Old): ' . $oldpath . ', Path (New): ' . $newpath, OCP\Util::INFO);
    }
    static public function copy($params) {
        $user = OCP\User::getUser();
        $oldpath = $params['oldpath'];
        $newpath = $params['newpath'];
        OCP\Util::writeLog('copy', 'Username: ' . $user . ', Path (Old): ' . $oldpath . ', Path (New): ' . $newpath, OCP\Util::INFO);
    }
    static public function post_copy($params) {
        $user = OCP\User::getUser();
        $oldpath = $params['oldpath'];
        $newpath = $params['newpath'];
        OCP\Util::writeLog('post_copy', 'Username: ' . $user . ', Path (Old): ' . $oldpath . ', Path (New): ' . $newpath, OCP\Util::INFO);
    }
     
    //Filesharing
    static public function post_share($params) {
        var_dump($params);
        echo $params;
        $user = OCP\User::getUser();
        $path = $params['fileTarget'];
        $with = $params['shareWith'];
        $owner = $params['uidOwner'];
        OCP\Util::writeLog('post_share', 'Path: ' . $path. ', Shared by ' . $user . ' with ' . $with . ', Owned by: ' . $owner, OCP\Util::INFO); 
    }
    static public function post_unshare($params) {
        $user = OCP\User::getUser();
        $path = $params['fileTarget'];
        $with = $params['shareWith'];
        $owner = $params['uidOwner'];
        OCP\Util::writeLog('post_unshare', 'Path: ' . $path. ', Shared by ' . $user . ' with ' . $with . ', Owned by: ' . $owner, OCP\Util::INFO); 
    }

}
