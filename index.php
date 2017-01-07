<?php
     define('BOT_TOKEN','محل توکن');
     $update = json_decode(urldecode(file_get_contents('php://input')));
     $chat_id = $update->message->chat->id;
     $gp_title = $update->message->chat->title;
     $gp_type = $update->message->chat->type;
     $user_first_name = $update->message->from->first_name;
     $user_last_name = $update->message->from->last_name;
     $user_name = $update->message->from->username;
     $user_id = $update->message->from->id;
     $user_ids = $update->message->from->id;
     $forward_from = $update->message->forward_from;
     $from_first_name = $forward_from->first_name;
     $from_last_name = $forward_from->last_name;
     $from_id = $forward_from->id;
     $from_username = $forward_from->username;
     $forward_from_chat = $update->message->forward_from_chat;
     $from_chat_title = $forward_from_chat->title;
     $from_chat_id = $forward_from_chat->id;
     $from_chat_username = $forward_from_chat->username;
     $from_chat_type = $forward_from_chat->type;
     $from_chat_msg_id = $update->message->forward_from_message_id;
     $bot_id = json_decode(urldecode(file_get_contents('https://api.telegram.org/bot'.BOT_TOKEN.'/getme')))->result->id;
     function bot($method,$fields)
     {$url = 'https://api.telegram.org/bot'.BOT_TOKEN.'/'.$method;
     $ch = curl_init();
     curl_setopt($ch, CURLOPT_URL, $url);
     curl_setopt($ch, CURLOPT_POST, count($fields));
     curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
     $answer = curl_exec($ch);
     curl_close($ch);}
     function sendMessage($chat_id,$text,$message_id)
     {$fields = array('chat_id'=>$chat_id,'text'=>$text,'parse_mode'=>'html','reply_to_message_id'=>$message_id,'disable_web_page_preview'=>'true');bot('sendMessage',$fields);}
  file_get_contents('https://api.telegram.org/bot'.BOT_TOKEN.'/sendChatAction?chat_id='.$chat_id.'&action=typing');
  if ($user_first_name != null && $forward_from == null && $forward_from_chat == null)
     {$user_first_names = "\n<b>Firstname</b> : ".$user_first_name;}
  if ($user_last_name != null && $forward_from == null && $forward_from_chat == null)
     {$user_last_names = "\n<b>Lastname</b> : ".$user_last_name;}
  if ($user_name != null && $forward_from == null && $forward_from_chat == null)
     {$user_names = "\n<b>Username</b> : @".$user_name;}
  if ($forward_from == null && $forward_from_chat == null)
     {$user_info = "\n\n<i>Your info</i>";$user_ids = "\n<b>Id</b> : ".$user_id;}
  else {$user_info = ""; $user_ids = "";}
  if ($from_first_name != null)
     {$from_first_names = "\n<b>Firstname</b> : ".$from_first_name;}
  if ($from_last_name != null)
     {$from_last_names = "\n<b>Lastname</b> : ".$from_last_name;}
  if ($from_id != null)
     {$from_info = "<i>User info</i>";$from_ids = "\n<b>Id</b> : ".$from_id;}
  else {$from_info = "";$from_ids = "";}
  if ($user_id == $from_id)
     {$from_info = "\n\n<i>Your info</i>";}
  elseif ($bot_id == $from_id)
     {$from_info = "<i>My info</i>";}
  if ($from_username != null)
     {$from_usernames = "\n<b>Username</b> : @".$from_username;}
  if ($from_chat_title != null)
     {$from_chat_titles = "\n<b>Title</b> : ".$from_chat_title;}
  if ($from_chat_type != null)
     {$from_chat_types = "\n<b>Type</b> : ".$from_chat_type;}
  if ($from_chat_id != null)
     {$chat_info = "\n\n<i>Chat info</i>";$from_chat_ids = "\n<b>Id</b> : ".$from_chat_id;}
  if ($from_chat_username != null)
     {$from_chat_usernames = "\n<b>Username</b> : @".$from_chat_username;}
  if ($from_chat_msg_id != null && $from_chat_username != null)
     {$from_chat_msg_ids = "\n<b>Message link</b> : https://telegram.me/".$from_chat_username."/".$from_chat_msg_id;}
  elseif ($from_chat_msg_id != null)
     {$from_chat_msg_ids = "\n<b>Message id</b> : ".$from_chat_msg_id;}
  if ($chat_id != $user_id)
     {$gp_info = "<i>Group info</i>";$gp_types = "\n<b>Type</b> : ".$gp_type;$gp_titles = "\n<b>Title</b> : ".$gp_title;$gp_ids = "\n<b>Id</b> : ".$chat_id;}
  $info = $gp_info.$gp_types.$gp_titles.$gp_ids.$user_info.$user_first_names.$user_last_names.$user_names.$user_ids.$from_info.$from_first_names.$from_last_names.$from_usernames.$from_ids.$chat_info.$from_chat_types.$from_chat_titles.$from_chat_usernames.$from_chat_ids.$from_chat_msg_ids;
  sendMessage($chat_id,$info);
?>
