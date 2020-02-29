<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

  public function ldapCheck ($username, $password){
   $server = "10.15.179.66";
   $dn = "ou=people,dc=pins,dc=co,dc=id";

	//error_reporting(0);
   ldap_connect($server);
   $con = ldap_connect($server);
   ldap_set_option($con, LDAP_OPT_PROTOCOL_VERSION, 3);

  // dd($con);

  // if ((string) $con === "Resource id #340") {
  //   $message = "Connect ke intranet yaa :) boleh pake GlobalProtect atau F5";
  //   $user_search = ldap_search($con,$dn,"(|(uid=$username)(mail=$username))");

  //   if ($user_search) {
  //     return false;
  //   }
  //   echo "<script type='text/javascript'>alert('$message'); window.location='../login'</script>";
  // }

	//echo ($con ." - ". $user ." - ". $passw);
  	// bind anon and find user by uid
   $user_search = ldap_search($con,$dn,"(|(uid=$username)(mail=$username))");
   $user_get = ldap_get_entries($con, $user_search);
   $user_entry = ldap_first_entry($con, $user_search);
   if (!empty($user_entry)) {
    $user_dn = ldap_get_dn($con, $user_entry);

  		/*if (ldap_bind($con, $user_dn, $password) === false){
  	    	$message[] = "Error E101 - Current Username or Password is wrong.";
  	    	return false;
  	  	}
        return true;*/

        $bind = @ldap_bind($con, $user_dn, $password);
        if (!$bind) {
         return false;
       }
       return true;
     }
     return false;
   }

   public function leveldesc(){
    $lvldesc = array ("Administrator","AVP Budget","Dir.Utama","Dir.FBS",
      "Dir.Operation","Dir.Sales","GM Ecommerce","GM Sales","GM Solution",
      "Manager Sales","VP Accounting","VP Sales","VP Treasury");

    return $lvldesc;
  }
}
