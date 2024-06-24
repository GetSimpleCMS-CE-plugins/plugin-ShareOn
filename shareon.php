<?php

# get correct id for plugin
$shareon = basename(__FILE__, ".php");

# add in this plugin's language file
i18n_merge($shareon) || i18n_merge($shareon, 'en_US');

# register plugin
register_plugin(
	$shareon, 								# ID of plugin, should be filename minus php
	i18n_r($shareon.'/lang_Menu_Title'), 	# Title of plugin
	'1.0', 									# Plugin version
	'islander',								# Plugin author
	'https://getsimple-ce.ovh/ce-plugins/', # Author URL
	i18n_r($shareon.'/lang_Description'),	# Plugin Description
	'plugins',								# Page type of plugin
	'shareon' 								# Function that displays content
);

# Front-End Hooks
add_action('theme-header','shareon_css');
add_action('theme-footer','shareon_js'); 

# Back-End Hooks
add_action('plugins-sidebar', 'createSideMenu', array($shareon, i18n_r($shareon.'/lang_Menu_Title')));


# ===== Main Plugin Function =====
function shareon(){
	global $SITEURL;
	global $USR;
	if (file_exists(GSDATAOTHERPATH . 'shareon.json')) {
		$file = GSDATAOTHERPATH . 'shareon.json';
		$fileData = json_decode(file_get_contents($file), true);

		$Facebook 	= $fileData['Facebook'];
		$Fediverse 	= $fileData['Fediverse'];
		$LinkedIn 	= $fileData['LinkedIn'];
		$Mastodon 	= $fileData['Mastodon'];
		$Messenger 	= $fileData['Messenger'];
		$Messenger_ID = $fileData['Messenger_ID'];
		$Odnoklassniki = $fileData['Odnoklassniki'];
		$Pinterest 	= $fileData['Pinterest'];
		$Pocket 	= $fileData['Pocket'];
		$Reddit 	= $fileData['Reddit'];
		$Teams 		= $fileData['Teams'];
		$Telegram 	= $fileData['Telegram'];
		$Tumblr 	= $fileData['Tumblr'];
		$Twitter 	= $fileData['Twitter'];
		$Viber 		= $fileData['Viber'];
		$VKontakte 	= $fileData['VKontakte'];
		$Whatsapp 	= $fileData['Whatsapp'];
		
		$Line_Break = $fileData['Line_Break'];
		
		$Copy_URL 	= $fileData['Copy_URL'];
		$Email 		= $fileData['Email'];
		$Print 		= $fileData['Print'];
		$Web_Share 	= $fileData['Web_Share'];
		
		$Extra_Code = $fileData['Extra_Code'];
	};

	echo '
	<link rel="stylesheet" href="'.$SITEURL.'plugins/shareon/assets/w3.css">
	<style>
		.tablink{background-color:#ededf0}
		.tablink{border-top-left-radius: 15px;}
		.tablink{border-top-right-radius: 15px;}
		.no-hover{height:30px}
		.no-hover:hover{background-color:#fff !important;}
		.sharon svg{width:16px;}
		.credit-icon{vertical-align:text-bottom;font-size:1.2em}
	</style>
	
	<div class="w3-parent w3-container">
		<h3>'.i18n_r("shareon/lang_Page_Title").'</h3>
		<p>'.i18n_r("shareon/lang_Description").'</p>
		
		<hr>

		<div class="w3-bar w3-white">
			<button class="w3-bar-item w3-button tablink w3-orange" onclick="openTab(event,\'Options\')">'.i18n_r("shareon/lang_Share_Buttons").'</button>
			<button class="w3-bar-item w3-button tablink" onclick="openTab(event,\'Info\')">'.i18n_r("shareon/lang_Info").'</button>
		</div>

		<div id="Options" class="w3-container w3-border-top tab">
			
			<form class="w3-container w3-padding-32" method="POST">
				
				<div class="w3-row">
					<div class="w3-half">
						<ul class="w3-ul w3-hoverable sharon">
							<li>
								<input class="w3-check" type="checkbox" name="Facebook" value="true" ' . (@$Facebook == "true" ? 'checked' : '') . '>
								<label>
									<svg fill="#1877f2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073"/></svg> Facebook 
								</label>
							</li>
							<li>
								<input class="w3-check" type="checkbox" name="Fediverse" value="true" ' . (@$Fediverse == "true" ? 'checked' : '') . '>
								<label>
									<svg fill="#8a54af" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M5.239 8.64a2.43 2.43 0 0 1-1.041 1.036l5.714 5.736 1.377-.698zm7.537 7.566-1.378.698 2.895 2.907a2.43 2.43 0 0 1 1.041-1.037zm6.61-5.297-3.234 1.64.238 1.526 3.66-1.856a2.43 2.43 0 0 1-.663-1.31m-5.113 2.592-7.649 3.876a2.43 2.43 0 0 1 .664 1.31l7.223-3.66zm-2.46-9.549-3.69 7.205 1.089 1.094 3.908-7.628a2.43 2.43 0 0 1-1.307-.67m-4.65 9.078-1.87 3.65a2.44 2.44 0 0 1 1.307.67l1.652-3.226zm-2.998-3.34a2.44 2.44 0 0 1-1.216.255 3 3 0 0 1-.235-.025l1.092 6.983a2.44 2.44 0 0 1 1.216-.255q.118.007.234.025zm3.129 9.03a2.4 2.4 0 0 1 .025.49 2.4 2.4 0 0 1-.256.96l6.98 1.121a2.4 2.4 0 0 1-.025-.49 2.4 2.4 0 0 1 .257-.96zm12.78-6.476-3.222 6.29a2.43 2.43 0 0 1 1.307.671l3.222-6.29a2.43 2.43 0 0 1-1.307-.671M15.68 3.348a2.44 2.44 0 0 1-1.04 1.036l4.99 5.01a2.43 2.43 0 0 1 1.04-1.037zm-4.554-.731L4.818 5.813a2.43 2.43 0 0 1 .663 1.31l6.309-3.197a2.43 2.43 0 0 1-.664-1.31m3.502 1.774a2.44 2.44 0 0 1-1.236.264 3 3 0 0 1-.213-.022l.559 3.578 1.524.244zm-.565 5.9 1.32 8.46a2.43 2.43 0 0 1 1.199-.246q.128.007.254.028l-1.249-7.998zM5.486 7.15a2.4 2.4 0 0 1 .027.498 2.4 2.4 0 0 1-.253.953l3.58.575.704-1.374zm6.137.986L10.92 9.51l8.46 1.36a2.4 2.4 0 0 1-.024-.485 2.4 2.4 0 0 1 .26-.966zM13.645.015a2.212 2.212 0 1 0-.24 4.418 2.212 2.212 0 1 0 .24-4.418m8.261 8.293a2.212 2.212 0 1 0-.24 4.418 2.212 2.212 0 1 0 .24-4.418M16.57 18.725a2.212 2.212 0 1 0-.24 4.419 2.212 2.212 0 1 0 .24-4.419M5.01 16.871a2.212 2.212 0 1 0-.24 4.418 2.212 2.212 0 1 0 .24-4.418M3.204 5.307a2.212 2.212 0 1 0-.24 4.418 2.212 2.212 0 1 0 .24-4.418"/></svg> Fediverse 
								</label>
							</li>
							<li>
								<input class="w3-check" type="checkbox" name="LinkedIn" value="true" ' . (@$LinkedIn == "true" ? 'checked' : '') . '>
								<label>
									<svg fill="#0a66c2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M23.722 23.72h-4.91v-7.692c0-1.834-.038-4.194-2.559-4.194-2.56 0-2.95 1.995-2.95 4.06v7.827H8.394V7.902h4.716v2.157h.063c.659-1.244 2.261-2.556 4.655-2.556 4.974 0 5.894 3.274 5.894 7.535v8.683ZM.388 7.902h4.923v15.819H.388zM2.85 5.738A2.85 2.85 0 0 1 0 2.886a2.851 2.851 0 1 1 2.85 2.852"/></svg> LinkedIn 
								</label>
							</li>
							<li>
								<input class="w3-check" type="checkbox" name="Mastodon" value="true" ' . (@$Mastodon == "true" ? 'checked' : '') . '>
								<label>
									<svg fill="#6364ff" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M23.268 5.313c-.35-2.578-2.617-4.61-5.304-5.004C17.51.242 15.792 0 11.813 0h-.03c-3.98 0-4.835.242-5.288.309C3.882.692 1.496 2.518.917 5.127.64 6.412.61 7.837.661 9.143c.074 1.874.088 3.745.26 5.611.118 1.24.325 2.47.62 3.68.55 2.237 2.777 4.098 4.96 4.857 2.336.792 4.849.923 7.256.38q.398-.092.786-.213c.585-.184 1.27-.39 1.774-.753a.06.06 0 0 0 .023-.043v-1.809a.05.05 0 0 0-.02-.041.05.05 0 0 0-.046-.01 20.3 20.3 0 0 1-4.709.545c-2.73 0-3.463-1.284-3.674-1.818a5.6 5.6 0 0 1-.319-1.433.053.053 0 0 1 .066-.054c1.517.363 3.072.546 4.632.546.376 0 .75 0 1.125-.01 1.57-.044 3.224-.124 4.768-.422q.059-.011.11-.024c2.435-.464 4.753-1.92 4.989-5.604.008-.145.03-1.52.03-1.67.002-.512.167-3.63-.024-5.545m-3.748 9.195h-2.561V8.29c0-1.309-.55-1.976-1.67-1.976-1.23 0-1.846.79-1.846 2.35v3.403h-2.546V8.663c0-1.56-.617-2.35-1.848-2.35-1.112 0-1.668.668-1.67 1.977v6.218H4.822V8.102q0-1.965 1.011-3.12c.696-.77 1.608-1.164 2.74-1.164 1.311 0 2.302.5 2.962 1.498l.638 1.06.638-1.06c.66-.999 1.65-1.498 2.96-1.498 1.13 0 2.043.395 2.74 1.164q1.012 1.155 1.012 3.12z"/></svg> Mastodon 
								</label>
							</li>
							<li>
								<input class="w3-check" type="checkbox" name="Messenger" value="true" ' . (@$Messenger == "true" ? 'checked' : '') . '>
								<label>
									<svg fill="#00b2ff" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M.001 11.639C.001 4.949 5.241 0 12.001 0S24 4.95 24 11.639s-5.24 11.638-12 11.638c-1.21 0-2.38-.16-3.47-.46a.96.96 0 0 0-.64.05l-2.39 1.05a.96.96 0 0 1-1.35-.85l-.07-2.14a.97.97 0 0 0-.32-.68A11.39 11.389 0 0 1 .002 11.64zm8.32-2.19-3.52 5.6c-.35.53.32 1.139.82.75l3.79-2.87c.26-.2.6-.2.87 0l2.8 2.1c.84.63 2.04.4 2.6-.48l3.52-5.6c.35-.53-.32-1.13-.82-.75l-3.79 2.87c-.25.2-.6.2-.86 0l-2.8-2.1a1.8 1.8 0 0 0-2.61.48"/></svg> Messenger  
								</label>
								<input class="w3-input w3-border w3-round" type="text" style="margin-left:15px;display: inline-block;width:55%" name="Messenger_ID" placeholder="'.i18n_r("shareon/lang_App_ID").'" value="'. @$Messenger_ID .'">
							</li>
							<li>
								<input class="w3-check" type="checkbox" name="Odnoklassniki" value="true" ' . (@$Odnoklassniki == "true" ? 'checked' : '') . '>
								<label>
									<svg fill="#ee8208" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M12 0a6.2 6.2 0 0 0-6.194 6.195 6.2 6.2 0 0 0 6.195 6.192 6.2 6.2 0 0 0 6.193-6.192A6.2 6.2 0 0 0 12.001 0zm0 3.63a2.567 2.567 0 0 1 2.565 2.565 2.57 2.57 0 0 1-2.564 2.564 2.57 2.57 0 0 1-2.565-2.564 2.567 2.567 0 0 1 2.565-2.564zM6.807 12.6a1.814 1.814 0 0 0-.91 3.35 11.6 11.6 0 0 0 3.597 1.49l-3.462 3.463a1.815 1.815 0 0 0 2.567 2.566L12 20.066l3.405 3.403a1.813 1.813 0 0 0 2.564 0c.71-.709.71-1.858 0-2.566l-3.462-3.462a11.6 11.6 0 0 0 3.596-1.49 1.814 1.814 0 1 0-1.932-3.073 7.87 7.87 0 0 1-8.34 0c-.318-.2-.674-.29-1.024-.278"/></svg> Odnoklassniki 
								</label>
							</li>
							<li>
								<input class="w3-check" type="checkbox" name="Pinterest" value="true" ' . (@$Pinterest == "true" ? 'checked' : '') . '>
								<label>
									<svg fill="#bd081c" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.162-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.099.12.112.225.085.345-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.401.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.354-.629-2.758-1.379l-.749 2.848c-.269 1.045-1.004 2.352-1.498 3.146 1.123.345 2.306.535 3.55.535 6.607 0 11.985-5.365 11.985-11.987C23.97 5.39 18.592.026 11.985.026z"/></svg> Pinterest
								</label>
							</li>
							<li>
								<input class="w3-check" type="checkbox" name="Pocket" value="true" ' . (@$Pocket == "true" ? 'checked' : '') . '>
								<label>
									<svg fill="#ef3f56" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="m18.813 10.259-5.646 5.419a1.65 1.65 0 0 1-2.282 0l-5.646-5.419a1.645 1.645 0 0 1 2.276-2.376l4.511 4.322 4.517-4.322a1.643 1.643 0 0 1 2.326.049 1.64 1.64 0 0 1-.045 2.326zm5.083-7.546a2.16 2.16 0 0 0-2.041-1.436H2.179c-.9 0-1.717.564-2.037 1.405-.094.25-.142.511-.142.774v7.245l.084 1.441c.348 3.277 2.047 6.142 4.682 8.139q.069.053.143.105l.03.023a11.9 11.9 0 0 0 4.694 2.072c.786.158 1.591.24 2.389.24.739 0 1.481-.067 2.209-.204.088-.029.176-.045.264-.06.023 0 .049-.015.074-.029a12 12 0 0 0 4.508-2.025l.029-.031.135-.105c2.627-1.995 4.324-4.862 4.686-8.148L24 10.678V3.445c0-.251-.031-.5-.121-.742z"/></svg> Pocket 
								</label>
							</li>
							<li>
								<input class="w3-check" type="checkbox" name="Reddit" value="true" ' . (@$Reddit == "true" ? 'checked' : '') . '>
								<label>
									<svg fill="#ff4500" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M19.512 1.173a1.88 1.88 0 0 1 1.877 1.874 1.884 1.884 0 0 1-1.877 1.857c-.99 0-1.817-.783-1.873-1.773l-3.897-.82-1.201 5.623c2.737.105 5.223.949 7.015 2.234a2.53 2.53 0 0 1 1.812-.737A2.634 2.634 0 0 1 24 12.063c0 1.075-.653 2-1.516 2.423q.066.388.063.78c0 4.043-4.698 7.31-10.512 7.31s-10.512-3.267-10.512-7.31c0-.275.022-.55.064-.801a2.63 2.63 0 0 1-1.559-2.402 2.634 2.634 0 0 1 2.633-2.632c.694 0 1.347.294 1.811.735 1.812-1.325 4.32-2.146 7.12-2.232l1.329-6.276a.5.5 0 0 1 .21-.296.52.52 0 0 1 .357-.063l4.361.926c.3-.644.952-1.057 1.663-1.052M7.917 18.052c-.13 0-.254.05-.347.14a.497.497 0 0 0 0 .696c1.264 1.263 3.728 1.37 4.444 1.37s3.16-.084 4.444-1.37a.545.545 0 0 0 .044-.695.5.5 0 0 0-.697 0c-.82.8-2.527 1.095-3.77 1.095s-2.97-.294-3.77-1.095a.5.5 0 0 0-.348-.143zm-.051-5.989A1.88 1.88 0 0 0 5.99 13.94c0 1.031.842 1.873 1.876 1.873a1.88 1.88 0 0 0 1.873-1.874 1.88 1.88 0 0 0-1.873-1.875Zm8.254 0a1.88 1.88 0 0 0-1.873 1.876c0 1.031.842 1.873 1.875 1.873a1.88 1.88 0 0 0 1.875-1.874 1.88 1.88 0 0 0-1.877-1.875"/></svg> Reddit 
								</label>
							</li>
							<li>
								<input class="w3-check" type="checkbox" name="Teams" value="true" ' . (@$Teams == "true" ? 'checked' : '') . '>
								<label>
									<svg fill="#6264a7" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M20.625 8.127q-.55 0-1.025-.205t-.832-.563-.563-.832T18 5.502q0-.54.205-1.02t.563-.837q.357-.358.832-.563.474-.205 1.025-.205.54 0 1.02.205t.837.563q.358.357.563.837t.205 1.02q0 .55-.205 1.025t-.563.832q-.357.358-.837.563t-1.02.205m0-3.75q-.469 0-.797.328t-.328.797.328.797.797.328.797-.328.328-.797-.328-.797-.797-.328M24 10.002v5.578q0 .774-.293 1.46t-.803 1.194q-.51.51-1.195.803-.686.293-1.459.293-.445 0-.908-.105-.463-.106-.85-.329-.293.95-.855 1.729t-1.319 1.336-1.67.861-1.898.305q-1.148 0-2.162-.398-1.014-.399-1.805-1.102t-1.312-1.664-.674-2.086h-5.8q-.411 0-.704-.293T0 16.881V6.873q0-.41.293-.703t.703-.293h8.59q-.34-.715-.34-1.5 0-.727.275-1.365.276-.639.75-1.114.475-.474 1.114-.75.638-.275 1.365-.275t1.365.275 1.114.75q.474.475.75 1.114.275.638.275 1.365t-.275 1.365q-.276.639-.75 1.113-.475.475-1.114.75-.638.276-1.365.276-.188 0-.375-.024-.188-.023-.375-.058v1.078h10.875q.469 0 .797.328t.328.797M12.75 2.373q-.41 0-.78.158-.368.158-.638.434-.27.275-.428.639-.158.363-.158.773t.158.78q.159.368.428.638.27.27.639.428t.779.158.773-.158q.364-.159.64-.428.274-.27.433-.639t.158-.779-.158-.773q-.159-.364-.434-.64-.275-.275-.639-.433-.363-.158-.773-.158M6.937 9.814h2.25V7.94H2.814v1.875h2.25v6h1.875zm10.313 7.313v-6.75H12v6.504q0 .41-.293.703t-.703.293H8.309q.152.809.556 1.5.405.691.985 1.19.58.497 1.318.779.738.281 1.582.281.926 0 1.746-.352.82-.351 1.436-.966.615-.616.966-1.43.352-.815.352-1.752m5.25-1.547v-5.203h-3.75v6.855q.305.305.691.452.387.146.809.146.469 0 .879-.176.41-.175.715-.48.304-.305.48-.715t.176-.879"/></svg> Teams 
								</label>
							</li>
						</ul>
					</div>
					<div class="w3-half">
						<ul class="w3-ul w3-hoverable sharon">
							<li>
								<input class="w3-check" type="checkbox" name="Telegram" value="true" ' . (@$Telegram == "true" ? 'checked' : '') . '>
								<label>
									<svg fill="#26a5e4" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M20.888 3.551c.168-.003.54.039.781.235.162.14.264.335.288.547.026.156.06.514.033.793-.302 3.189-1.616 10.924-2.285 14.495-.282 1.512-.838 2.017-1.378 2.066-1.17.11-2.058-.773-3.192-1.515-1.774-1.165-2.777-1.889-4.5-3.025-1.99-1.31-.7-2.033.434-3.209.297-.309 5.455-5.002 5.556-5.427.012-.054.024-.252-.094-.356s-.292-.069-.418-.04q-.267.061-8.504 5.62-1.208.831-2.187.806c-.72-.013-2.104-.405-3.134-.739C1.025 13.39.022 13.174.11 12.476q.068-.544 1.5-1.114 8.816-3.84 11.758-5.064c5.599-2.328 6.763-2.733 7.521-2.747Z"/></svg> Telegram 
								</label>
							</li>
							<li>
								<input class="w3-check" type="checkbox" name="Tumblr" value="true" ' . (@$Tumblr == "true" ? 'checked' : '') . '>
								<label>
									<svg fill="#36465d" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M14.563 24c-5.093 0-7.031-3.756-7.031-6.411V9.747H5.116V6.648c3.63-1.313 4.512-4.596 4.71-6.469C9.84.051 9.941 0 9.999 0h3.517v6.114h4.801v3.633h-4.82v7.47c.016 1.001.375 2.371 2.207 2.371h.09c.631-.02 1.486-.205 1.936-.419l1.156 3.425c-.436.636-2.4 1.374-4.156 1.404h-.178z"/></svg> Tumblr 
								</label>
							</li>
							<li>
								<input class="w3-check" type="checkbox" name="Twitter" value="true" ' . (@$Twitter == "true" ? 'checked' : '') . '>
								<label>
									<svg fill="#1d9bf0" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M21.543 7.104c.015.211.015.423.015.636 0 6.507-4.954 14.01-14.01 14.01v-.003A13.94 13.94 0 0 1 0 19.539a9.88 9.88 0 0 0 7.287-2.041 4.93 4.93 0 0 1-4.6-3.42 4.9 4.9 0 0 0 2.223-.084A4.926 4.926 0 0 1 .96 9.167v-.062a4.9 4.9 0 0 0 2.235.616A4.93 4.93 0 0 1 1.67 3.148a13.98 13.98 0 0 0 10.15 5.144 4.929 4.929 0 0 1 8.39-4.49 9.9 9.9 0 0 0 3.128-1.196 4.94 4.94 0 0 1-2.165 2.724A9.8 9.8 0 0 0 24 4.555a10 10 0 0 1-2.457 2.549"/></svg> Twitter 
								</label>
							</li>
							<li>
								<input class="w3-check" type="checkbox" name="Viber" value="true" ' . (@$Viber == "true" ? 'checked' : '') . '>
								<label>
									<svg fill="#7360f2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M11.4 0C9.473.028 5.333.344 3.02 2.467 1.302 4.187.696 6.7.633 9.817S.488 18.776 6.12 20.36h.003l-.004 2.416s-.037.977.61 1.177c.777.242 1.234-.5 1.98-1.302.407-.44.972-1.084 1.397-1.58 3.85.326 6.812-.416 7.15-.525.776-.252 5.176-.816 5.892-6.657.74-6.02-.36-9.83-2.34-11.546-.596-.55-3.006-2.3-8.375-2.323 0 0-.395-.025-1.037-.017zm.058 1.693c.545-.004.88.017.88.017 4.542.02 6.717 1.388 7.222 1.846 1.675 1.435 2.53 4.868 1.906 9.897v.002c-.604 4.878-4.174 5.184-4.832 5.395-.28.09-2.882.737-6.153.524 0 0-2.436 2.94-3.197 3.704-.12.12-.26.167-.352.144-.13-.033-.166-.188-.165-.414l.02-4.018c-4.762-1.32-4.485-6.292-4.43-8.895.054-2.604.543-4.738 1.996-6.173 1.96-1.773 5.474-2.018 7.11-2.03zm.38 2.602a.304.304 0 0 0-.004.607c1.624.01 2.946.537 4.028 1.592 1.073 1.046 1.62 2.468 1.633 4.334.002.167.14.3.307.3a.304.304 0 0 0 .3-.304c-.014-1.984-.618-3.596-1.816-4.764-1.19-1.16-2.692-1.753-4.447-1.765zm-3.96.695a.98.98 0 0 0-.616.117l-.01.002c-.43.247-.816.562-1.146.932l-.008.008q-.4.484-.46.948a.6.6 0 0 0-.007.14q0 .205.065.4l.013.01c.135.48.473 1.276 1.205 2.604.42.768.903 1.5 1.446 2.186q.405.517.87.984l.132.132q.466.463.984.87a15.5 15.5 0 0 0 2.186 1.447c1.328.733 2.126 1.07 2.604 1.206l.01.014a1.3 1.3 0 0 0 .54.055q.466-.055.948-.46c.004 0 .003-.002.008-.005.37-.33.683-.72.93-1.148l.003-.01c.225-.432.15-.842-.18-1.12-.004 0-.698-.58-1.037-.83q-.54-.383-1.113-.71c-.51-.285-1.032-.106-1.248.174l-.447.564c-.23.283-.657.246-.657.246-3.12-.796-3.955-3.955-3.955-3.955s-.037-.426.248-.656l.563-.448c.277-.215.456-.737.17-1.248a13 13 0 0 0-.71-1.115 28 28 0 0 0-.83-1.035.82.82 0 0 0-.502-.297zm4.49.88a.303.303 0 0 0-.018.606c1.16.085 2.017.466 2.645 1.15.63.688.93 1.524.906 2.57a.306.306 0 0 0 .61.013c.025-1.175-.334-2.193-1.067-2.994-.74-.81-1.777-1.253-3.05-1.346h-.024zm.463 1.63a.305.305 0 0 0-.3.287c-.008.167.12.31.288.32.523.028.875.175 1.113.422.24.245.388.62.416 1.164a.304.304 0 0 0 .605-.03c-.03-.644-.215-1.178-.58-1.557-.367-.378-.893-.574-1.52-.607h-.018z"/></svg> Viber 
								</label>
							</li>
							<li>
								<input class="w3-check" type="checkbox" name="VKontakte" value="true" ' . (@$VKontakte == "true" ? 'checked' : '') . '>
								<label>
									<svg fill="#0077ff" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M4.199 4.841H.11c.194 9.312 4.85 14.907 13.012 14.907h.462v-5.327c3 .299 5.268 2.492 6.178 5.327H24c-1.164-4.237-4.223-6.58-6.133-7.475 1.91-1.105 4.596-3.79 5.238-7.432h-3.85c-.836 2.955-3.313 5.641-5.67 5.895V4.84h-3.85v10.326C7.347 14.57 4.333 11.675 4.199 4.84Z"/></svg> VKontakte 
								</label>
							</li>
							<li>
								<input class="w3-check" type="checkbox" name="Whatsapp" value="true" ' . (@$Whatsapp == "true" ? 'checked' : '') . '>
								<label>
									<svg fill="#25d366" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52s.198-.298.298-.497c.099-.198.05-.371-.025-.52s-.669-1.612-.916-2.207c-.242-.579-.487-.5-.669-.51a13 13 0 0 0-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074s2.096 3.2 5.077 4.487c.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413s.248-1.289.173-1.413c-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.82 9.82 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.82 11.82 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.9 11.9 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.82 11.82 0 0 0-3.48-8.413"/></svg> Whatsapp  
								</label>
							</li>
							
							<!--li class="no-hover"></li-->
							
							<li>
								<input class="w3-check" type="checkbox" name="Line_Break" value="true" ' . (@$Line_Break == "true" ? 'checked' : '') . '>
								<label>
									&mdash; '.i18n_r("shareon/lang_Line_Break").'
								</label>
							</li>
							
							<li>
								<input class="w3-check" type="checkbox" name="Copy_URL" value="true" ' . (@$Copy_URL == "true" ? 'checked' : '') . '>
								<label>
									<svg fill="#8a54af" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/></svg> '.i18n_r("shareon/lang_Copy_URL").'
								</label>
							</li>
							<li>
								<input class="w3-check" type="checkbox" name="Email" value="true" ' . (@$Email == "true" ? 'checked' : '') . '>
								<label>
									<svg fill="#8a54af" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><g fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><rect height="16" rx="2" width="20" x="2" y="4"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></g></svg> '.i18n_r("shareon/lang_Email").'
								</label>
							</li>
							<li>
								<input class="w3-check" type="checkbox" name="Print" value="true" ' . (@$Print == "true" ? 'checked' : '') . '>
								<label>
									<svg fill="#8a54af" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 9V2h12v7M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2M6 14h12v8H6z"/></svg> '.i18n_r("shareon/lang_Print").' 
								</label>
							</li>
							<!--li>
								<input class="w3-check" type="checkbox" name="Web_Share" value="true" ' . (@$Web_Share == "true" ? 'checked' : '') . '>
								<label>
									<svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path fill="none" stroke="#000" stroke-width="2" d="M18 2a3 3 0 1 0 0 6 3 3 0 1 0 0-6zM6 9a3 3 0 1 0 0 6 3 3 0 1 0 0-6zm12 7a3 3 0 1 0 0 6 3 3 0 1 0 0-6zm-9.41-2.49 6.83 3.98m-.01-10.98-6.82 3.98"/></svg> Web Share 
								</label>
							</li-->
						</ul>
					</div>
					
					<div class="w3-row w3-padding-32">
					<hr>
						<p>'.i18n_r("shareon/lang_Additional_Code").':</p>
						<textarea class="w3-input w3-border w3-codespan" style="height:100px;font-size:.9em" name="Extra_Code">'. @$Extra_Code .'</textarea>
					</div>
				</div>
				
				<span style="margin-left: 15%;">
					<button class="w3-btn w3-large w3-round-large w3-green" style="width:66.6%" name="saveShareon">'.i18n_r("shareon/lang_Save").'</button>
				</span>
				
			</form>
		</div>

		<div id="Info" class="w3-container w3-border-top tab" style="display:none">
			
			<div class="w3-container w3-padding-48">
				<h4>'.i18n_r("shareon/lang_Instructions").':</h4>
				<p><b>'.i18n_r("shareon/lang_How_Add").'</b></p>
				<p style="padding-bottom:30px">
					'.i18n_r("shareon/lang_How_Add_Info").' <br><br>
					<code class="w3-codespan">&lt;?php addShareOn();?></code>
				</p>
				
				<h4>'.i18n_r("shareon/lang_Help").':</h4>
				<p><b>'.i18n_r("shareon/lang_How_Find").'</b></p>
				<p style="padding-bottom:30px">
					'.i18n_r("shareon/lang_How_Find_info").'
				</p>
				
				<p><b>'.i18n_r("shareon/lang_How_Make").'</b></p>
				<p style="padding-bottom:30px">
					'.i18n_r("shareon/lang_How_Make_info").'<br><br>
					<code class="w3-codespan">
					&lt;style><br>
					&nbsp;&nbsp; .shareon > ::before {background-size:12px;top:4px;left:4px;}<br>
					&nbsp;&nbsp; .shareon > * {padding:4px;height:12px;min-width:12px;}<br>
					&lt;/style>
					</code>
				</p>
				
				<p><b>'.i18n_r("shareon/lang_How_to_Change").'</b></p>
				<p style="padding-bottom:30px">
					'.i18n_r("shareon/lang_How_Make_info").'<br><br>
					<code class="w3-codespan">
					&lt;style><br>
					&nbsp;&nbsp; .shareon > .twitter {background-color: #000;}<br>
					&nbsp;&nbsp; .shareon > .twitter::before {background-image: url(\'data:image/svg+xml,&lt;svg fill="%23fff" role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">&lt;title>X&lt;/title>&lt;path d="M18.901 1.153h3.68l-8.04 9.19L24 22.846h-7.406l-5.8-7.584-6.638 7.584H.474l8.6-9.83L0 1.154h7.594l5.243 6.932ZM17.61 20.644h2.039L6.486 3.24H4.298Z"/>&lt;/svg>\');}<br>
					&lt;/style>
					</code>
				</p>
				
				<h4>'.i18n_r("shareon/lang_Credits").'</h4>
				<p>'.i18n_r("shareon/lang_Based_On").' <a href="https://github.com/kytta/shareon/" target="_blank">Shareon v2.5.0</a></p>
			</div>
		</div>
		
		<hr>
		
		<div class="w3-opacity">
			<p>Made with <span class="credit-icon">❤️</span> especially for "<b>'.$USR.'</b>".<br>
			Is this plugin useful for you? <a href="https://www.paypal.com/donate/?hosted_button_id=C3FTNQ78HH8BE" target="_blank">Consider buying me a <span class="credit-icon">☕</span></a>.</p>
		</div>
	</div>
	
	<script>
		function openTab(evt, tabName) {
			var i, x, tablinks;
			x = document.getElementsByClassName("tab");
			for (i = 0; i < x.length; i++) {
				x[i].style.display = "none";
			}
			tablinks = document.getElementsByClassName("tablink");
			for (i = 0; i < x.length; i++) {
				tablinks[i].className = tablinks[i].className.replace(" w3-orange", "");
			}
			document.getElementById(tabName).style.display = "block";
			evt.currentTarget.className += " w3-orange";
		}
	</script>
	';
	
	if (isset($_POST['saveShareon'])) {
		$data = [];
		
		$data['Facebook'] 	= $_POST['Facebook'];
		$data['Fediverse'] 	= $_POST['Fediverse'];
		$data['LinkedIn'] 	= $_POST['LinkedIn'];
		$data['Mastodon'] 	= $_POST['Mastodon'];
		$data['Messenger'] 	= $_POST['Messenger'];
		$data['Messenger_ID'] = $_POST['Messenger_ID'];
		$data['Odnoklassniki'] = $_POST['Odnoklassniki'];
		$data['Pinterest'] 	= $_POST['Pinterest'];
		$data['Pocket'] 	= $_POST['Pocket'];
		$data['Reddit'] 	= $_POST['Reddit'];
		$data['Teams'] 		= $_POST['Teams'];
		$data['Telegram'] 	= $_POST['Telegram'];
		$data['Tumblr'] 	= $_POST['Tumblr'];
		$data['Twitter'] 	= $_POST['Twitter'];
		$data['Viber'] 		= $_POST['Viber'];
		$data['VKontakte'] 	= $_POST['VKontakte'];
		$data['Whatsapp'] 	= $_POST['Whatsapp'];
		
		$data['Line_Break'] 	= $_POST['Line_Break'];
		
		$data['Copy_URL'] 	= $_POST['Copy_URL'];
		$data['Email'] 		= $_POST['Email'];
		$data['Print'] 		= $_POST['Print'];
		$data['Web_Share'] 	= $_POST['Web_Share'];
		
		$data['Extra_Code'] = $_POST['Extra_Code'];

		$finalData = json_encode($data);

		file_put_contents(GSDATAOTHERPATH . 'shareon.json', $finalData);

		echo "<meta http-equiv='refresh' content='0'>";
	};
	
}

# ===== Front-End functions Header =====
function shareon_css() {
	global $SITEURL;
	echo '
	<link rel="stylesheet" href="'.$SITEURL.'plugins/shareon/assets/shareon.css">
	';
}

# ===== Front-End functions Footer =====
function shareon_js() {
	global $SITEURL;
	echo '
	<script src="'.$SITEURL.'plugins/shareon/assets/shareon.js" defer init></script>
';
}

# ===== Placeholder for Theme =====
function addShareOn(){

	$file = GSDATAOTHERPATH . 'shareon.json';
    $readFile = file_get_contents($file);
    $readFileJson = json_decode($readFile, true); // Use true to get an associative array
	
    if (!empty($readFileJson['Extra_Code'])) {
		echo '
		
		'.$readFileJson['Extra_Code'].'';
	}
	
	echo '
	
	<!-- start shareon -->
	<div class="shareon">	';
	
	if (@$readFileJson['Facebook'] == "true") {
		echo '
		<a class="facebook"></a>';
	};
	
	if (@$readFileJson['Fediverse'] == "true") {
		echo '
		<a class="fediverse"></a>';
	};
	
	if (@$readFileJson['LinkedIn'] == "true") {
		echo '
		<a class="linkedin"></a>';
	};
	
	if (@$readFileJson['Mastodon'] == "true") {
		echo '
		<a class="mastodon"></a>';
	};
	
	//if (@$readFileJson['Messenger'] == "true") {
	if (!empty($readFileJson['Messenger_ID'])) {
		echo '
		<a class="messenger" data-fb-app-id="'. @$readFileJson['Messenger_ID'] .'"></a>';
	};
	
	if (@$readFileJson['Odnoklassniki'] == "true") {
		echo '
		<a class="odnoklassniki"></a>';
	};
	
	if (@$readFileJson['Pinterest'] == "true") {
		echo '
		<a class="pinterest"></a>';
	};
	
	if (@$readFileJson['Pocket'] == "true") {
		echo '
		<a class="pocket"></a>';
	};
	
	if (@$readFileJson['Reddit'] == "true") {
		echo '
		<a class="reddit"></a>';
	};
	
	if (@$readFileJson['Teams'] == "true") {
		echo '
		<a class="teams"></a>';
	};
	
	if (@$readFileJson['Telegram'] == "true") {
		echo '
		<a class="telegram"></a>';
	};
	
	if (@$readFileJson['Tumblr'] == "true") {
		echo '
		<a class="tumblr"></a>';
	};
	
	if (@$readFileJson['Twitter'] == "true") {
		echo '
		<a class="twitter"></a>';
	};
	
	if (@$readFileJson['Viber'] == "true") {
		echo '
		<a class="viber"></a>';
	};
	
	if (@$readFileJson['VKontakte'] == "true") {
		echo '
		<a class="vkontakte"></a>';
	};
	
	if (@$readFileJson['Whatsapp'] == "true") {
		echo '
		<a class="whatsapp"></a>';
	};
	
	//if (@$readFileJson['Copy_URL'] == "true" || @$readFileJson['Email'] == "true" || @$readFileJson['Print'] == "true" || @$readFileJson['Web_Share'] == "true") {
	if (@$readFileJson['Line_Break'] == "true") {
		echo '
		<br>';
	};
		
	if (@$readFileJson['Copy_URL'] == "true") {
		echo '
		<a class="copy-url"></a>';
	};
	
	if (@$readFileJson['Email'] == "true") {
		echo '
		<a class="email"></a>';
	};
	
	if (@$readFileJson['Print'] == "true") {
		echo '
		<a class="print"></a>';
	};
	
	if (@$readFileJson['Web_Share'] == "true") {
		echo '
		<a class="web-share"></a>';
	};
	
	echo '
	</div>
	<!-- end shareon -->

';
/* ----------------
  (\ /)
  (^.^) -{hola)
 C(")(")
---------------- */
}