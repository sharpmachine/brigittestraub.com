<?
class youtube_auth{
	var $authResponseUrl;
	var $username;
	var $password;
	var $authType;
	var $accessToken;
	var $sessionToken;
	public function __construct($params=array()){
		foreach ($params as $key=>$value){
			$this->$key=$value;
		}
		if (!empty($this->authToken)){
			$this->authSubSessionToken();
		}
	}
	public function clientLoginAuth($username,$pass){
		$this->authType = 'GoogleLogin';
		$url = 'https://www.google.com/youtube/accounts/ClientLogin';
		$data = 'Email='.urlencode($username).'&Passwd='.urlencode($pass).'&service=youtube&source=Test';
		$result = array();
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$curlheader[0] = "Content-Type:application/x-www-form-urlencoded";
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt($ch, CURLOPT_HTTPHEADER, $curlheader);
		$result['output'] = curl_exec($ch);
		$result['err'] = curl_errno( $ch );
		$result['errmsg']  = curl_error( $ch );
		$result['header']  = curl_getinfo( $ch );
		$temp = explode("YouTubeUser=",$result['output']);
		$result['username'] = trim($temp[1]);
		$temp2 = explode("=",trim($temp[0]));
		$result['token'] = trim($temp2[1]);
		$this->setAccessToken($result['token']);
		curl_close($ch);
		$this->username = !empty($result['username'])?$result['username']:'';
		return $result;
	}

	public function getCurrentUrl(){
		$pageURL = 'http';
		if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
		$pageURL .= "://";
		if ($_SERVER["SERVER_PORT"] != "80") {
			$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		} else {
			$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		}
		return $pageURL;
	}


	public function showAuthSubRequest($authResponseUrl=''){
		$urlParams['scope'] = 'http://gdata.youtube.com';
		$urlParams['session'] = 1;
		$urlParams['next'] = !empty($authResponseUrl)?$authResponseUrl:$this->authResponseUrl;
		if (empty($urlParams['next'])){
			$urlParams['next'] = $this->getCurrentUrl();
		}
		$params = http_build_query($urlParams);
		$url = 'https://www.google.com/accounts/AuthSubRequest?'.$params;
		header("Location:".$url);

	}

	public function setAccessToken($accessToken=''){
		$this->accessToken = $accessToken;
	}

	public function setSessionToken($sessionToken){
		$this->authType='AuthSub';
		$this->sessionToken = $sessionToken;
	}

	public function authSubSessionToken(){
		if (empty($this->accessToken)){
			$this->showAuthSubRequest();
		}
		$url = 'https://www.google.com/accounts/AuthSubSessionToken';
		$curlHeader[0] = 'Content-Type: application/x-www-form-urlencoded';
		$curlHeader[1] = 'Authorization: AuthSub token="'.$this->accessToken.'"';
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt($ch, CURLOPT_HTTPHEADER, $curlHeader);
		$result['output'] = curl_exec($ch);
		$result['err'] = curl_errno( $ch );
		$result['errmsg']  = curl_error( $ch );
		$result['header']  = curl_getinfo( $ch );
		if ($result['err']==0 && $result['header']['http_code']==200){
			$data = explode('=',$result['output']);
			$this->setSessionToken($data[1]);
		}
		return $result;

	}
}

class youtube_uploader extends youtube_auth{
	var $uploadResponseUrl;
	var $developerKey;
	var $videoId;
	
	public function __construct($params=array()){
		foreach ($params as $key=>$value){
			$this->$key=$value;
		}
	}

	public function getCategories(){
		$url = 'http://gdata.youtube.com/schemas/2007/categories.cat';
		$categoriesArray = array();
		$xml = simplexml_load_file($url);
		$namespaces = $xml->getNamespaces(true);
		foreach ($namespaces as $key=>$namespace){
			$xml->registerXPathNamespace($key, $namespace);
		}
		foreach ($xml->xpath('atom:category') as $entry){
			if ($entry->xpath('yt:assignable')){
				$CatObject = new stdClass();
				$CatObject->Value = (string)$entry['term'];
				$CatObject->Description = (string)$entry['label'];
				$categoriesArray[] = $CatObject;
			}
		}
		return $categoriesArray;
	}

	public function createApiXmlRequest($params=array()){
		$return = '<'.'?xml version="1.0"?'.'>
	<entry xmlns="http://www.w3.org/2005/Atom" xmlns:media="http://search.yahoo.com/mrss/" xmlns:yt="http://gdata.youtube.com/schemas/2007">
	<media:group>
	<media:title type="plain">'.$params['title'].'</media:title>
	<media:description type="plain">'.$params['description'].'</media:description>
	<media:category scheme="http://gdata.youtube.com/schemas/2007/categories.cat">'.$params['category'].'</media:category>    <media:keywords>'.$params['keywords'].'</media:keywords>
	</media:group>
	</entry>
			';
		return $return;
	}

	public function updateVideoData($params=array()){
		if (!empty($params['videoId'])){
			$this->videoId = $params['videoId'];
		}
		$url = 'http://gdata.youtube.com/feeds/api/users/default/uploads/'.$params['videoId'];
		$data = $this->createApiXmlRequest($params);
		$curlHeader[0] = 'Host: gdata.youtube.com';
		$curlHeader[1] = 'Content-Type: application/atom+xml';
		$curlHeader[2] = 'Content-Length: '.strlen($data);
		$curlHeader[3] = "Authorization: ".$this->authType." ".(($this->authType == 'GoogleLogin')?'auth':'token')."=\"".(!empty($this->sessionToken)?$this->sessionToken:$this->accessToken)."\"";
		$curlHeader[4] = 'GData-Version: 2';
		$curlHeader[5] = 'X-GData-Key: key="'.$this->developerKey.'"';
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $curlHeader);
		$result['output'] = curl_exec($ch);
		$output = curl_exec($ch);
		$info = curl_getinfo($ch);
		curl_close($ch);
		return $result;
	}

	public function getUploadToken($params=array()){
		$token = $this->accessToken;
		$developerKey = $this->developerKey;
		$response = '';
		$data = $this->createApiXmlRequest($params);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'http://gdata.youtube.com/action/GetUploadToken');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$curlheader[0] = "Host: gdata.youtube.com";
		if($this->authType == 'GoogleLogin'){
			$curlheader[1] = "Authorization: ".$this->authType." auth=\"$token\"";
		}
		else {
			if (!empty($this->sessionToken)){
				$curlheader[1] = "Authorization: ".$this->authType." token=\"".$this->sessionToken."\"";
			} else {
				$curlheader[1] = "Authorization: ".$this->authType." token=\"".$this->accessToken."\"";
			}
		}
		$curlheader[2] = "GData-Version: 2";
		$curlheader[3] = "X-GData-Client: 1";
		$curlheader[3] = "X-GData-Key: key=\"".$developerKey."\"";
		$curlheader[4] = "Content-Type: application/atom+xml";
		$curlheader[5] = "Accept-encoding: identity";
		$curlheader[6] = "Content-Length: ".strlen($data);
		$curlheader[7] = "Connection: close";
		curl_setopt($ch, CURLOPT_HTTPHEADER, $curlheader);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		$output = curl_exec($ch);
		$info = curl_getinfo($ch);
		curl_close($ch);
		$result = $this->parseResults($output);
		if($result['status'] == 'ok')
		{
			$returnUrl = (string) $result['xml']->url[0];
			$returnToken = (string) $result['xml']->token[0];
			return array('status'=>'ok','url'=>!empty($returnUrl)?$returnUrl:'','token'=>!empty($returnToken)?$returnToken:'');
		} else {
			return array('status'=>'error','message'=>$result['error_message']);
		}
	}

	public function checkUploadedVideo($params=array()){
		$url = 'http://gdata.youtube.com/feeds/api/users/'.$params['username'].'/uploads/'.$params['videoid'];
		$result = array();
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$result['output'] = curl_exec($ch);
		$result['err'] = curl_errno( $ch );
		$result['errmsg']  = curl_error( $ch );
		$result['header']  = curl_getinfo( $ch );
		curl_close($ch);
		$xml = simplexml_load_string($result['output']);
		$tmp = $xml->xpath("app:control");
		if ($tmp[0]->xpath("yt:state")){
			$status = $tmp[0]->xpath("yt:state");
			$result['status'] = $status[0];
			$result['error'] = $status[0];
		} else {
			$result['status']='ok';
			$result['error']='';
			$result['mediaInfo'] = $this->getVideoInfo(array('videoid'=>$params['videoid']));
		}
		return $result;
			
	}

	public function getUploadedVideos($params=array()){
		$developerKey = $this->developerKey;
		$url = 'http://gdata.youtube.com/feeds/api/users/default/uploads?start-index='.$params['start-index'].'&max-results='.$params['max-results'];//newmaxresults;
		$token = $this->accessToken;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		if($this->authType == 'GoogleLogin'){
			$curlheader[1] = "Authorization: ".$this->authType." auth=\"".$this->accessToken."\"";
		}
		else {
			if (!empty($this->sessionToken)){
				
				$curlheader[1] = "Authorization: ".$this->authType." token=\"".$this->sessionToken."\"";
			} 
		}
		$curlheader[2] = "X-GData-Key: key=\"$developerKey\"";
		$curlheader[3] = "Content-Type:application/x-www-form-urlencoded";
		curl_setopt($ch, CURLOPT_HTTPHEADER, $curlheader);
		$output = curl_exec($ch);
		$result['output'] = $output;
		$result['err'] = curl_errno( $ch );
		$result['errmsg']  = curl_error( $ch );
		$result['header']  = curl_getinfo( $ch );
		curl_close($ch);
		return $result;
	}

	public function formatVideoResponse($output){
		$xml = new SimpleXMLElement($output);
		$mediaInfo = array();
		$i=0;
		//Youtube has <feed><entry>...</entry></feed> response for getting uploaded videos and <entry>...</entry> response for updated video
		//so we have to find a workaround for handling the 2 types of responses
		if ($xml->getName() == 'entry'){
			$childreen[0]=$xml;
		} else {
			$childreen = $xml->entry;
		}
		foreach ($childreen as $entry){
			$app = $yt = $gd = $media = '';
			$namespaces = $entry->getNameSpaces(true);
			foreach ($namespaces as $key=>$namespace){
				if (!empty($key)){
					$entry->registerXPathNamespace($key, $namespace);
					$$key = $entry->children($namespace);
				}
			}
			$mediaInfo[$i]['videoId'] = !empty($this->videoId)?$this->videoId:basename($entry->id);
			$mediaInfo[$i]['published'] = preg_replace('/\.\w+/i','',str_replace('T',' ',basename($entry->published)));
			if ($app){
				$ytState = $app->xpath('yt:state');
				if ($ytState){
					//processing, restricted, deleted, rejected and failed.
					$mediaInfo[$i]['status'] = (string)$ytState[0]->attributes()->name;
					if ($mediaInfo[$i]['status'] != 'processing'){
						$mediaInfo[$i]['reason'] = (string)$ytState[0]->attributes()->reasonCode;
					}
				} else {
					$mediaInfo[$i]['status'] = 'OK';
				}
			} else {
				$mediaInfo[$i]['status'] = 'OK';
			}
			if($gd->rating){
				$rating = (string)$gd->rating->attributes();
				$mediaInfo[$i]['rating'] = $rating['average'];
			}else{
				$mediaInfo[$i]['rating'] = 0;
			}
			if ($media->group->category){
				$mediaInfo[$i]['category'] = sprintf("%s",$media->group->category[0]);
			}
			if($media->group->title){
				$mediaInfo[$i]['title'] = sprintf("%s",$media->group->title[0]);
			}else{
				$mediaInfo[$i]['title'] = '';
			}
			if($media->group->thumbnail){
				$mediaInfo[$i]['thumbnails']['default'] = sprintf("%s",$media->group->thumbnail[0]->attributes()->url);
			}else{
				$mediaInfo[$i]['thumbnails']['default'] = '';
			}

			if($media->group->keywords){
				$mediaInfo[$i]['tags'] = sprintf("%s",$media->group->keywords[0]);
			}else{
				$mediaInfo[$i]['tags'] = '';
			}

			if($media->group->description){
				$mediaInfo[$i]['description'] = sprintf("%s",$media->group->description[0]);
			}else{
				$mediaInfo[$i]['description'] = '';
			}
			$i++;
		}
		return $mediaInfo;
	}


	public function parseResults($response){
		$result = array();
		$result['status'] = 'ok';
		$reg_ex = '/<H1>Bad Request<\/H1>/';

		$res = preg_match_all($reg_ex,$response,$matches);
		if(!empty($matches[0])) {
			$result['status'] = 'error';
			$result['error'] = "Bad Request";
		}
		else {

			$xml = @simplexml_load_string($response);
			if($xml === FALSE && $response !=''){
				$result['error'] = $response;
				$result['status'] = 'error';
			}
			else{
				if(@$xml->error){
					$msg = @(string)$xml->error->code.':'.@(string)$xml->error->internalReason;
					$location = @(string)$xml->error->location;
					unset($xml);
					$result['error']['message'] = $msg;
					$result['error']['location'] = $location;
					$result['status'] = 'error';
				}
				else{
					$result['xml'] = $xml;
				}
			}
		}
		unset($xml);
		unset($response);
		return $result;

	}
}


?>
