//Fix for swfupload redirect bug
//in case of http_error, try to set the upload as complete and get the last id from youtube
function youtubeUploadError(fileObj, errorCode, message) {

	switch (errorCode) {
		case SWFUpload.UPLOAD_ERROR.MISSING_UPLOAD_URL:
			wpFileError(fileObj, swfuploadL10n.missing_upload_url);
			break;
		case SWFUpload.UPLOAD_ERROR.UPLOAD_LIMIT_EXCEEDED:
			wpFileError(fileObj, swfuploadL10n.upload_limit_exceeded);
			break;
		case SWFUpload.UPLOAD_ERROR.HTTP_ERROR:
			if (message==302){
        //make ajax request to get the last uploaded video for this user
        jQuery.get(youtubeCheckUrl, function(data) {
          var serverData = data;
          uploadSuccess(fileObj,serverData);
          
        });
      }
			break;
		case SWFUpload.UPLOAD_ERROR.UPLOAD_FAILED:
			wpQueueError(swfuploadL10n.upload_failed);
			break;
		case SWFUpload.UPLOAD_ERROR.IO_ERROR:
			wpQueueError(swfuploadL10n.io_error);
			break;
		case SWFUpload.UPLOAD_ERROR.SECURITY_ERROR:
			wpQueueError(swfuploadL10n.security_error);
			break;
		case SWFUpload.UPLOAD_ERROR.UPLOAD_STOPPED:
		case SWFUpload.UPLOAD_ERROR.FILE_CANCELLED:
			jQuery('#media-item-' + fileObj.id).remove();
			break;
		default:
			wpFileError(fileObj, swfuploadL10n.default_error);
	}
}

function insertIntoPost(html){
  var win = window.dialogArguments || opener || parent || top;
  win.send_to_editor(html);
}

function youtubeRefresh(type,element){
	if (type=='html'){
    	window.location.reload();
	} else {
		jQuery(element).hide();
		jQuery(element).siblings('span').show();
		jQuery.get(youtubeCheckUrl, function(data) {
		jQuery(element).parents("div[id*='media-item-']").html(data);
        jQuery(element).parents("div[id*='media-content']").html(data);
		jQuery(element).show();
        jQuery(element).siblings('span').hide();
    });
  }
}

function updateYoutubeVideo(videoId,type,element){
  parentVideo = jQuery(element).parents("div#'media-upload-content");
  jQuery("#updateVideoLabel").show();
  jQuery("#updateYoutubeVideo").hide();
  jQuery.post('admin-ajax.php', {title : jQuery("#youtube_uploader_title").val(),tags:jQuery("#youtube_uploader_tags").val(),description:jQuery("#youtube_uploader_description").val(),category:jQuery("#youtube_uploader_categories").val(), videoId:videoId, type : type, action:"update_youtube_video", 'cookie': encodeURIComponent(document.cookie)},
    function(str){
      parentVideo.html(str);
    });
}
