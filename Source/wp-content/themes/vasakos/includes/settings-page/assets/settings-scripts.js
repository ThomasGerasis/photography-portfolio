jQuery(document).ready(function() {

if (document.getElementById("sortable1") !== null) {
    jQuery(function () {
        const sortable_list2 = jQuery('#sortable2');
        jQuery("#sortable1, #sortable2").sortable({
            sort: function (event, ui) {
                if ('#sortable2' === ui.item.parent()) {
                    alert(ui.item.attr('data-id'));
                }
            },
            receive: function (event, ui) {
                if ('sortable1' === ui.sender.attr('id')) {
                    mVal += ',' + ui.item.attr('data-id');
                }
                if ('sortable2' === ui.sender.attr('id')) {
                    mVal = mVal.replace(',' + ui.item.attr('data-id'), '');
                    sortable_list2.attr('data-front', mVal);
                    hiddenpatent.attr('value', mVal);
                }
            },
            update: function (event, ui) {
                if ('sortable2' === ui.item.parent().attr('id')) {
                    var mVal = '';
                    sortable_list2.find('li').each(function () {
                        mVal += ',' + jQuery(this).attr('data-id');
                    });
                    //mVal = mVal.substring(1);
                    sortable_list2.attr('data-front', mVal);
                    jhiddenpatent.attr('value', mVal);

                }
            },
            connectWith: ".connectedSortable"
        }).disableSelection();
    });
}

    jQuery( ".repeater-rows-links" ).sortable({
        placeholder: "sortable-placeholder",
        create: function(event, ui){
        },
        update: function(event, ui){
            sortableIn = 1;
        },
    }).disableSelection();




if (document.querySelector('.custom_media_button') !== null) {
        media_upload('.custom_media_button');
}

if (document.getElementsByClassName('repeater-content-links').length > 0) {

        const containers = document.querySelectorAll('.repeater-content-links');
        console.log(containers);

        containers.forEach((container, index) => {
            const rows = container.querySelector('.repeater-rows-links');
            let datagroup = container.dataset.group;
            let count = parseInt(rows.children[(rows.children.length -1)]?.dataset?.id) + 1;

            container.addEventListener('click', (e) => {
                if(e.target.classList.contains('repeater-add-btn')){
                    e.preventDefault();

                    let mediaButton = '<input type="button" class="button button-primary custom_media_button custom_media_'+ count + '"  id="custom_media_button" data-name="repeat" name="' + count + '"  value="Upload Icon" style="margin-top:5px;">';
                    let imgPreview = '<img class="custom_media_image_'+ count + '" src="" style="margin:10px;padding:0;max-width:100px;float:left;display:inline-block" >';
                    let inputmedia = '<input type="text"  placeholder="image" class="media_image_'+ count + ' form-control form-control-sm col-3" data-name="repeat" name="' + datagroup + '[' + count + '][image]" id="' + datagroup + '_" value="" placeholder="Image">';
                    let containersTitle = '<textarea class="form-control form-control-sm col-2 main-text" data-name="repeat" name="' + datagroup + '[' + count + '][title]" id="' + datagroup + '_"  placeholder="Title"></textarea>';
                    let containersLastText = '<textarea class="form-control form-control-sm col-2 main-text" data-name="repeat" name="' + datagroup + '[' + count + '][text]" id="' + datagroup + '_"  placeholder="text"></textarea>';
                    let containersLastDeleteBtn = '<div class="pull-right repeater-remove-btn col-2">' +
                        '<button class="remove-btn bg-red text-fff action_btns">Remove</button>' +
                        '</div>';

                    const div = document.createElement('div');
                    div.classList.add(...['items', 'd-flex','mb-1']);
                    div.style.display = `flex`;
                    div.style.alignItems = `center`;
                    div.innerHTML = `${mediaButton} ${imgPreview} ${inputmedia} ${containersTitle} ${containersLastText} ${containersLastDeleteBtn}`;
                    rows.insertAdjacentElement('beforeend', div);
                    count++;
                }

                if(e.target.classList.contains('remove-btn')){
                    e.preventDefault();
                    e.target.parentElement.parentElement.remove();
                }
            })
        })
    }

});

function media_upload(button_class) {
    var _custom_media = true,
        _orig_send_attachment = wp.media.editor.send.attachment;
    jQuery('body').on('click', button_class, function(e) {
        var button_id = '#' + jQuery(this).attr('id');
        var self = jQuery(button_id);
        var send_attachment_bkp = wp.media.editor.send.attachment;
        var button = jQuery(button_id);
        var id = button.attr('id').replace('_button', '');
        var myName = jQuery(this).attr('name').replace('custom_media_button_', '');
        _custom_media = true;
        wp.media.editor.send.attachment = function(props, attachment) {
            if (_custom_media) {
                jQuery('.custom_media_id_' + myName).val(attachment.id);
                jQuery('.media_image_' + myName).val(attachment.url);
                jQuery('.custom_media_image_' + myName).attr('src', attachment.url).css('display', 'block');
            } else {
                return _orig_send_attachment.apply(button_id, [props, attachment]);
            }
        }
        wp.media.editor.open(button);
        return false;
    });
}