import { conformsTo, isSet } from 'lodash';
import Quill from 'quill';
// let icons = Quill.import('ui/icons');
let Block = Quill.import('blots/block');
let List = Quill.import('formats/list');
let ListItem = Quill.import('formats/list/item');

class HeaderBlot extends Block {
    static create(value) {
        let node = super.create(value);
        node.setAttribute('class', 'font-semibold');
        return node;
    }
}
HeaderBlot.blotName = 'header';
HeaderBlot.tagName = ['h1', 'h2'];

class FactList extends ListItem {
    // static create() {
    //     let node = super.create();
    //     console.log(node);
    //     console.log(node.parentNode);
    //     return node;
    // }

    format(name, value) {
        // console.log('format value:', value);
        // console.log('format name:', name);
        // console.log(this.domNode.parentNode);
        if(name === 'list' && value) {
            this.domNode.parentNode.setAttribute('class', value);
        } else {
            super.format(name, value);
        }
    }
}

class FactContainer extends List {
    static create(value) {
        let node = super.create();
        node.setAttribute('class', value);
        // console.log('create node: ', node);
        return node;
    }

    static formats(domNode) {
        return domNode.getAttribute('class');
    }
}

Quill.register(HeaderBlot);
Quill.register(FactList, true);
Quill.register(FactContainer, true);

const quillOptions = {
    placeholder: 'メモ',
    theme: 'snow',
    modules: {
        toolbar: '#toolbarContainer'
      }
  };

const quillSummaryOptions = {
    placeholder: '要約・自分の問い',
    theme: 'snow',
    modules: {
        toolbar: '#summaryToolbarContainer'
      }
  };

let quill = new Quill('#content', quillOptions);
let quillSummary = new Quill('#summary', quillSummaryOptions);

$(function() {
    // create/edit 
    var toolbarClicked = false;
    if(typeof(contentHtml) != 'undefined') {
        quill.container.firstChild.innerHTML = contentHtml
    }
    if(typeof(summaryHtml) != 'undefined') {
        quillSummary.container.firstChild.innerHTML = summaryHtml
    }

    $('#toolbarContainer, #summaryToolbarContainer').on('mousedown', function() {
        toolbarClicked = true;
    })

    $('#content').on('focusin', function() {
        $('#toolbarContainer').removeClass('hidden');
    })
    .on('focusout', function() {
        if(!toolbarClicked) {
            $('#toolbarContainer').addClass('hidden');
        } else {
            quill.focus();
        }
        toolbarClicked = false;
    });

    $('#summary').on('focusin', function() {
        $('#summaryToolbarContainer').removeClass('hidden');
    })
    .on('focusout', function() {
        if(!toolbarClicked) {
            $('#summaryToolbarContainer').addClass('hidden');
        } else {
            quillSummary.focus();
        }
        toolbarClicked = false;
    });


    $('#page').on('click', function() {
        quill.format('header', 2);
    })
    // $('#fact').on('click', function() {
    //     quill.format('list', 'fact-list');
    // })
    // $('#abstraction').on('click', function() {
    //     quill.format('list', 'abstraction-list');
    // })
    // $('#action').on('click', function() {
    //     quill.format('list', 'action-list');
    // })
    $('input[name="book_photo"]').change(function(e){
        //ファイルオブジェクトを取得する
        var file = e.target.files[0];
        var reader = new FileReader();
    
        //画像でない場合は処理終了
        if(file.type.indexOf("image") < 0){
        alert("画像ファイルを指定してください。");
        return false;
        }

        var $previewContainer = $('#preview');

        if($previewContainer.hasClass('hidden')) {
            $previewContainer.removeClass('hidden');
            $previewContainer.html('<img src="">')
        }
    
        //アップロードした画像を設定する
        reader.onload = (function(file){
        return function(e){
            $("#preview img").attr("src", e.target.result);
            $("#preview img").attr("title", file.name);
        };
        })(file);
        reader.readAsDataURL(file);
    
    });

    $('#post').on('click', function() {
        $('#content h2').each(function(i, element){
            $(element).attr('id', `title${i+1}`)
        });

        var $content = $('input[name="content"]');
        var $summary = $('input[name="summary"]')
        $content.val(quill.root.innerHTML);
        $summary.val(quillSummary.root.innerHTML);

        if($content.val() == '<p><br></p>') {
            $content.val('');
        }

        if($summary.val() == '<p><br></p>') {
            $summary.val('');
        }

        document.forms.bookForm.submit();
    });

    // show js
    var isShown = false;

    $('#tableOfContents').on('show.bs.dropdown', function() {
        if(isShown) return;
        
        var $tableOfContents = $('#tableOfContents .dropdown-menu');

        $('.content h2').each(function(i, element) {
            var id = $(element).attr('id');
            var text = escape_html($(element).text());
            $tableOfContents.append(`<li><a class="dropdown-item" href="#${id}">${text}</a></li>`);
        });
        isShown = true;
    });

    var cropper;
    var image = document.getElementById('cropperImage');

    $('#uploadBookPhotoButton').on('click', function() {
        $('#uploadBookPhoto').trigger('click')
    })

    $('#uploadPhotoButton').on('click', function() {
        $('#uploadProfile').trigger('click');
    })

    $('#uploadBookButton').on('change', function(e) {
        //ファイルオブジェクトを取得する
        var file = e.target.files[0];
        var reader = new FileReader();
    
        //画像でない場合は処理終了
        if(file.type.indexOf("image") < 0){
            alert("画像ファイルを指定してください。");
            return false;
        }

        var $previewContainer = $('#preview');

        if($previewContainer.hasClass('hidden')) {
            $previewContainer.removeClass('hidden');
            $previewContainer.html('<img src="">')
        }
    
        //アップロードした画像を設定する
        reader.onload = (function(file){
        return function(e){
            $("#preview img").attr("src", e.target.result);
            $("#preview img").attr("title", file.name);
        };
        })(file);
        reader.readAsDataURL(file);
    })

    $('#uploadProfile').on('change', function(e) {
        //ファイルオブジェクトを取得する
        var file = e.target.files[0];

        //画像でない場合は処理終了
        if(file.type.indexOf("image") < 0){
            alert("画像ファイルを指定してください。");
            return false;
        }

        var done = function(url) {
            image.src = url;
            $('#cropperModal').modal('show');
        }

        var reader;

        if(URL) {
            done(URL.createObjectURL(file));
        } else if (FileReader) {
            reader = new FileReader();
            reader.onload = function (e) {
                done(reader.result);
            };
            reader.readAsDataURL(file);
        }
    })

    $('#cropperModal').on('shown.bs.modal', function() {
        cropper = new Cropper(image, {
            aspectRatio : 1,
            viewMode: 2,
            autoCropArea: 1,
        });
    }).on('hidden.bs.modal', function() {
        cropper.destroy();
        cropper = null;
    });

    $('#crop').on('click', function() {
        var croppedData = cropper.getData();
        var croppedImgUrl = cropper.getCroppedCanvas().toDataURL();
        $('#cropperPreview').attr('src', croppedImgUrl);
        var croppedJsonData = JSON.stringify(croppedData);
        $('#croppedData').val(croppedJsonData);
        // console.log($('#croppedData').val());
    });

    $('.follow-button').on('click', function() {
        var button_id = $(this).attr('id');
        if(button_id == 'following') {
            var following_data = {
                "following_id": following_id,
                "followed_id" : followed_id
            }
        } else if (button_id == 'unfollowing') {
            var following_data = {
                "following_id": following_id,
                "followed_id" : followed_id,
                "_method": "DELETE"
            }

        } else {
            console.log('could not the id of the button')
            return;
        }
    
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }  
        });
        $.ajax({
            type: "POST",
            url: url,
            datatype: "json",
            data: following_data,

            success: function(data) {
                console.log("Success");
                if(data === 'add') {
                    $('.follow-button').attr('id', 'unfollowing')
                    $('.follow-button').html(
                        "<i class=\"fas fa-user-check fa-lg\"></i>"
                    )
                }
                else if (data === 'delete') {
                    $('.follow-button').attr('id', 'following')
                    $('.follow-button').html(
                        "<i class=\"far fa-user fa-lg\"></i>"
                    )
                }
                else {
                    console.log('could not work');
                }
            },

            error: function(data) {
                console.log("Failed");
            }
        });
    });

})

function escape_html (string) {
    if(typeof string !== 'string') {
      return string;
    }
    return string.replace(/[&'`"<>]/g, function(match) {
      return {
        '&': '&amp;',
        "'": '&#x27;',
        '`': '&#x60;',
        '"': '&quot;',
        '<': '&lt;',
        '>': '&gt;',
      }[match]
    });
  }