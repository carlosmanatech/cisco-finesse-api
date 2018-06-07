<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Ussd;
use Illuminate\Http\Request;

class UssdController extends Controller
{
    /**
     * Retrieve the user for the given ID.
     *
     * @param  int  $id
     * @return Response
     */
    public function ready($agent)
    {
        $data = '<User>
        <state>READY</state>
        </User>';
        $conf = getConfiguration();
        if ($conf == NULL) {
            return response('Please Update Supervisor User Details from /api/v1/update-details', 401);
        }
        $username = $conf->username;
        $password = $conf->password;
        $fqdn = $conf->fqdn.':'.$conf->port;
        $return = changeState($fqdn, $agent, $data, $username, $password);
        if ($return[0] == 202) {
            return response('Success', 202);
        }
        else{
            return response($return[1], $return[0])->header('Content-Type', 'text/xml');
        }
    }
    public function notReady($agent)
    {
        $data = '<User>
        <state>NOT_READY</state>
        <reasonCodeId>1</reasonCodeId>
        </User>';
        $conf = getConfiguration();
        if ($conf == NULL) {
            return response('Please Update Supervisor User Details from /api/v1/update-details', 401);
        }
        $username = $conf->username;
        $password = $conf->password;
        $fqdn = $conf->fqdn.':'.$conf->port;
        $return = changeState($fqdn, $agent, $data, $username, $password);
        if ($return[0] == 202) {
            return response('Success', 202);
        }
        else{
            return response($return[1], $return[0])->header('Content-Type', 'text/xml');
        }
    }
    public function notReadyreason($agent, $state, $reasonid)
    {
        $state = strtoupper($state);
        $data = "<User>
        <state>{$state}</state>
        <reasonCodeId>{$reasonid}</reasonCodeId>
        </User>";
        $conf = getConfiguration();
        if ($conf == NULL) {
            return response('Please Update Supervisor User Details from /api/v1/update-details', 401);
        }
        $username = $conf->username;
        $password = $conf->password;
        $fqdn = $conf->fqdn.':'.$conf->port;
        $return = changeState($fqdn, $agent, $data, $username, $password);
        if ($return[0] == 202) {
            return response('Success', 202);
        }
        else{
            return response($return[1], $return[0])->header('Content-Type', 'text/xml');
        }
    }
    public function logOut($agent)
    {
        $data = '<User>
                <state>LOGOUT</state>
                <logoutAllMedia>true</logoutAllMedia></User>';
        $conf = getConfiguration();
        if ($conf == NULL) {
            return response('Please Update Supervisor User Details from /api/v1/update-details', 401);
        }
        $username = $conf->username;
        $password = $conf->password;
        $fqdn = $conf->fqdn.':'.$conf->port;
        $return = changeState($fqdn, $agent, $data, $username, $password);
        if ($return[0] == 202) {
            return response('Success', 202);
        }
        else{
            return response($return[1], $return[0])->header('Content-Type', 'text/xml');
        }
    }
    public function agentStatus($agent)
    {
        $conf = getConfiguration();
        if ($conf == NULL) {
            return response('Please Update Supervisor User Details from /api/v1/update-details', 401);
        }
        $username = $conf->username;
        $password = $conf->password;
        $fqdn = $conf->fqdn.':'.$conf->port;
        $return = getState($fqdn, $agent, $username, $password);
        $xml = simplexml_load_string($return[1]);
        $json = json_encode($xml);
        $arr = json_decode($json, true);
        $time = explode('T', $arr['stateChangeTime']);
        $time = str_replace('Z', '', $time[1]);
        $time = strtotime($time);
        $time = time() - $time;
        $idle = date('H:i:s', $time);
        $xml->addChild('idleTime', $idle );
        return response($xml->asXML(), $return[0])->header('Content-Type', 'text/xml');
    }
    public function agentDialog($agent)
    {
        $conf = getConfiguration();
        if ($conf == NULL) {
            return response('Please Update Supervisor User Details from /api/v1/update-details', 401);
        }
        $username = $conf->username;
        $password = $conf->password;
        $fqdn = $conf->fqdn.':'.$conf->port;
        $return = getDialog($fqdn, $agent, $username, $password);
        return response($return[1], $return[0])->header('Content-Type', 'text/xml');
    }
    public function ReasonCodes($agent)
    {
        $conf = getConfiguration();
        if ($conf == NULL) {
            return response('Please Update Supervisor User Details from /api/v1/update-details', 401);
        }
        $username = $conf->username;
        $password = $conf->password;
        $fqdn = $conf->fqdn.':'.$conf->port;
        $return = getReasonCodes($fqdn, $agent, $username, $password);
        if ($return[0] == 202) {
            return response($return[1], $return[0])->header('Content-Type', 'text/xml');
        }
        else{
            return response($return[1], $return[0])->header('Content-Type', 'text/xml');
        }
    }
    public function agentQueues($agent)
    {
        $conf = getConfiguration();
        if ($conf == NULL) {
            return response('Please Update Supervisor User Details from /api/v1/update-details', 401);
        }
        $username = $conf->username;
        $password = $conf->password;
        $fqdn = $conf->fqdn.':'.$conf->port;
        $return = getAgentsQueues($fqdn, $agent, $username, $password);
        return response($return[1], 200)->header('Content-Type', 'text/xml');
    }
    public function update()
    {
        $fqdn = $_POST['fqdn'];
        $port = $_POST['port'];
        $user = $_POST['user'];
        $password = $_POST['password'];
        $result = getConfiguration();
        if ($result != NULL) {
            DB::update("update cisco_finesse_installs set fqdn = ?, port = ?, username = ?, password = ? where id = ?", [$fqdn, $port, $user, $password, $result->id]);
        }
        else{
            DB::insert('insert into cisco_finesse_installs (fqdn, port, username, password) values (?, ?, ?, ?)', [$fqdn, $port, $user, $password]);
        }
        return view('details', ['fqdn' => $fqdn, 'port' => $port, 'user' => $user, 'password' => $password]);
    }
}