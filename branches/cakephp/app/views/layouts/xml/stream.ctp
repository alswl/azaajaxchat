<?php echo '<?xml version="1.0" encoding="UTF-8"?>' ?>
<stream time="<?php echo $streamTime;?>">
    <users>
        <user userId="<?php echo $userId;?>" channelId="<?php echo $channelId;?>">
            <?php echo $userLoginName;?>
        </user>
    </users>
    <messages>
    	<message from="<?php echo $messageFrom;?>" to="<?php echo $messageTo;?>"  time="<?php echo $messageTime;?>">
    		<?php echo $userLoginName;?>
    	</message>
    </messages>
</stream>
