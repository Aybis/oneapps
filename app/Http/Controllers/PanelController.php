<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class PanelController extends Controller
{
    public function AuthCheck(Request $request)
    {
    	/*$this->validate($request,
    		['username' => 'required'],
    		['password' => 'required'],
    	)

    	$user = $request->input('username');
    	$password = $request->input('password');*/

    	$adServer = "ldap://10.15.179.66/phpldapadmin";
    	$ldap = ldap_connect($adServer);
    	$username = $request->input('username');
    	// $username = $_POST['username'];
    	$password = $request->input('password');
    	// $password = $_POST['password'];
    	$ldaprdn = '10.15.179.66' . "\\" . $username;
    	ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
    	ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);
    	$bind = @ldap_bind($ldap, $ldaprdn, $password);

    	if ($bind) {

    		$filter="(samaccountname=$username)";

    		$result = ldap_search($ldap, "ou=people,dc=pins,dc=co,dc=id", $filter);
    		ldap_sort($ldap,$result,"sn");
    		$info = ldap_get_entries($ldap, $result);
    		echo "<pre>";
    		dd($info);
    		echo "</pre>";

    		for ($i=0; $i < $info['count']; $i++)
    		{
    			if ($info['count'] > 1)
    				break;
    			$info[$i]["samaccountname"][0];
    			$info[$i]["description"][0];
    		}

    		@ldap_close($ldap);
    	}
    }

    public function authLdap(Request $request){

    $usersData = User::all();
    $usernameTry = $request->input('username');
    $passwordTry = $request->input('password');

	$result = $this->ldapCheck($usernameTry, $passwordTry);

	if ($result) {
		return true;
	}
	else
		return false;
	}
}
