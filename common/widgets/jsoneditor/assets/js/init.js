function setGlobalOptions(conf) {
    JSONEditor.plugins.sceditor.style = '//cdn.jsdelivr.net/sceditor/1.4.3/jquery.sceditor.default.min.css';
    JSONEditor.plugins.sceditor.width = "754px";
    //JSONEditor.plugins.sceditor.toolbar = "bold|maximize|source,pastetext,bulletlist,orderedlist,removeformat|link";

    // Global Select2 options
    JSONEditor.plugins.select2.width = "100%";

    if (conf.fieldId.match(/head/)) {
        JSONEditor.defaults.editors.object.options.collapsed = true;
    }

    // Specify upload handler
    JSONEditor.defaults.options.upload = function (id, file, cbs) {

        var name = '_fileinput_' + id.replace(/\./g, '_');

        $('div[data-schemapath="' + id + '"]:visible').find('input[type="file"]').attr('id', id);
        $('div[data-schemapath="' + id + '"]:visible').find('input[type="file"]').attr('name', name);

        var data = new FormData();
        jQuery.each(jQuery('input[name="' + name + '"]')[0].files, function (i, file) {
            dump(file);
            data.append(name, file);
        });

        jQuery.ajax({
            url: '/file-storage/upload?fileparam=' + name,
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            type: 'POST',
            success: function (data) {
                dump(data);
                cbs.success(data.files[0].url);
            }
        });

        //url: "http://16on9.storage.dev/source/1/tlVu5m8CyGcxuADyIJIsfjYsIQgtRqTe.jpg"
        //delete_url: "/file-storage/upload-delete?path=1%2FtlVu5m8CyGcxuADyIJIsfjYsIQgtRqTe.jpg"
        //delete not allowed  http://16on9.backend.dev/file-storage/upload-delete?path=1/tlVu5m8CyGcxuADyIJIsfjYsIQgtRqTe.jpg

    }

    //add translations

    JSONEditor.defaults.languages.en['last'] = conf.translations['last'];
    JSONEditor.defaults.languages.en['delete_last'] = conf.translations['delete_last'];
    JSONEditor.defaults.languages.en['all'] = conf.translations['all'];
    JSONEditor.defaults.languages.en['delete_all'] = conf.translations['delete_all'];
    JSONEditor.defaults.languages.en['browse'] = conf.translations['browse'];


    /*JSONEditor.defaults.resolvers.unshift(function (schema) {
     if (schema.type === "string" && schema.format === "yiiUploadKit") {
     log("yiiUploadKit");            
     //jQuery('#w1').yiiUploadKit({"name":"root[common][image][content]","url":"/file-storage/upload?fileparam=_fileinput_w1","multiple":false,"sortable":false,"maxNumberOfFiles":1,"maxFileSize":5000000,"acceptFileTypes":null,"files":null});
     
     return "string";
     }
     
     // If no valid editor is returned, the next resolver function will be used
     });*/
}

function log(msg) {
    console.log('[jsoneditor] ' + msg);
}

function dump(v) {
    console.dir(v);
}

function initialize(conf) {
    log('initialize ' + conf.fieldId);
    // This is the starting value for the editor
    // We will use this to seed the initial editor         
    if (!$.isEmptyObject($("#" + conf.fieldId).val())) {
        conf.options.startval = $.parseJSON($("#" + conf.fieldId).val());
    }

    setGlobalOptions(conf);

    // Initialize the editor
    var editor = new JSONEditor(document.getElementById(conf.fieldId + '_holder'), conf.options);

    editor.on('change', function () {
        $("#" + conf.fieldId).val(JSON.stringify(editor.getValue()));
        //hardcoded hide preview title
        //wait for ui bug fix
        $('a[title*="http://frontend.renault.dev/img/widget_preview/"]').attr('title', 'preview');
        $('a[title*="http://platform.digitalua.com.ua/img/widget_preview/"]').attr('title', 'preview');
        $('a[title*="http://m.renault.ua/img/widget_preview/"]').attr('title', 'preview');

        $('.editor-tab-select option[value="Wysiwyg editor"]').hide();
        $('.editor-tab-select option[value="Promo Wysiwyg"]').hide();

        console.log('editor change ' + conf.fieldId);
        //CKEditor
        $('textarea[data-schemaformat="html"]').each(function (k, v) {
            if (!$(v).attr('id') && $(v).attr('name')) {
                var id = "id-" + Date.now() + '-' + Math.floor(Math.random() * 1000);
                $(v).attr('id', id);
                var name = $(v).attr('name').replace(/\]\[/g, '.').replace(/\]/g, '.').replace(/\[/g, '.').replace(/\.$/, '')
                console.log(name);
                initSample(id, editor.getEditor(name));

            }
        });
    });

    editor.on('ready', function () {
        // Now the api methods will be available        
        var name = editor.getEditor('root.common.title.content');

        if (name) {
            $(document).ready(function () {
                var contentFieldId = conf.fieldId.replace(/-head/, '-title');
                $('#' + contentFieldId).change(function () {
                    name.setValue($(this).val());
                });
            });
        }

    });

    log('conf :');
    dump(conf);
    log('editor :');
    dump(editor);

}

/*conf = $.parseJSON(conf);
 dump(conf);
 
 initialize(conf);*/


