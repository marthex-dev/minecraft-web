function chatAjax()
{

	$.ajax({

        url: "classes/ajax/Chat.ajax.php?type=get",
        success: function(data) {
            $("#adminChatBox").html(data);
        }

    });

}

$(function() {
    
    $("#adminChat").submit(function(e) {

    	$.ajax({

			url: "classes/ajax/Chat.ajax.php?type=submit",
			type: 'post',
			data: $("#adminChat").serialize(),
			success: function(data) {

			    chatAjax();
			    $("#adminChat")[0].reset();
				$('#adminChatBox').stop().animate({
					scrollTop: $('#adminChatBox')[0].scrollHeight
				}, 800);

			}

    	});

    	return false;

    });

});

$(document).ready(function() {

	setInterval(chatAjax, 1000);

});