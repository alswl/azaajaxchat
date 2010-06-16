<?php echo '<?xml version="1.0" encoding="UTF-8"?>' ?>
<stream userId="<?php echo $userId;?>" userLoginName="<?php echo $userLoginName;?>" time="<?php echo $streamTime;?>" channelId="<?php echo $channelId;?>">
    <users>
    	<?php echo $users;?>
    </users>
    <messages queryId="<?php echo $messagesQueryId;?>" responseId="<?php echo $messagesResponseId;?>">
    	<?php echo $messages;?>
    </messages>
</stream>
