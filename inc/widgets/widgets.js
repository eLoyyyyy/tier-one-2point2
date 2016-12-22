 /*Uploaded ng image*/
/* imageWidget = {
    uploader : function( widget_id_string ) {

        function media_upload(button_class) {
            var _custom_media = true,
            _orig_send_attachment = wp.media.editor.send.attachment;

            jQuery('body').on('click', button_class, function(e) {
                var button_id ='#'+jQuery(this).attr('id');
                var self = jQuery(button_id);
                var send_attachment_bkp = wp.media.editor.send.attachment;
                var button = jQuery(button_id);
                var id = button.attr('id').replace('_button', '');
                _custom_media = true;
                wp.media.editor.send.attachment = function(props, attachment){
                    if ( _custom_media  ) {
                       // jQuery("#" + widget_id_string + 'attachment_id').val(attachment.id);
                      // jQuery("#" + widget_id_string ).val(attachment.url);
                
                       jQuery("#" + widget_id_string ).val(attachment.url);                           
                       jQuery("#" + widget_id_string + 'preview').attr('src',attachment.url).css('display','block');
                    } else {
                        return _orig_send_attachment.apply( button_id, [props, attachment] );
                    }
                }
                wp.media.editor.open(button);
                    return false;
            });
        }
        media_upload('.custom_media_button.button');
    }
}

function imageUploader( ces ){
    imageWidget.uploader(ces); 
    return false;
}*/

jQuery(document).ready(function(){
    jQuery('.dt-img-upload').live('click', function(){
        var jw_attachment_link = wp.media.editor.send.attachment;
        var button = jQuery(this);
        wp.media.editor.send.attachment = function (props, attachment) {
            jQuery(button).prev().prev().attr('src', attachment.url);
            jQuery(button).prev().val(attachment.url);
            wp.media.editor.send.attachment = jw_attachment_link;
        };
        wp.media.editor.open(button);
        return false;
    });
});