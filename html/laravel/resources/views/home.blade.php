<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name') }}</title>


        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>
    <body>

        <div class="text-center" >
            <div id="resumable-error" style="display: none">
                Resumable not supported
            </div>
            <div id="resumable-drop" style="display: none">
                <p>
                    <button id="resumable-browse" data-url="{{ url('upload') }}" >Upload XML Files</button>
                </p>
                <p></p>
            </div>
            <ul id="file-upload-list" class="list-unstyled"  style="display: none">

            </ul>
            <div id='validation-errors' style="display: none">
                <h1>Validation Errors</h1>
                <ul id="upload-errors" class="list-unstyled" >

                </ul>
            </div>
            <br/>
        </div>

    </body>
    <script src="{{ asset('js/app.js') }}"></script>
    <script>

        const proccessData = function(evt){
            const target = evt.target;
            const path = $(target).data('file-path');
            const name = $(target).data('file-name');
            const original = $(target).data('original-name');
            let processing = $("<span>Proccessing...</span>");
            $(target).replaceWith(processing);
            $.ajax({
                type: 'POST',
                url: '{{route("app.xml.processing")}}',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'path': path,
                    'name': name
                },
                success: function(resp, textStatus, xhr) {
                    $(processing).replaceWith("Done!");
                },
                complete: function(xhr) {
                    if (xhr.status == 400) {
                        const resp = JSON.parse(xhr.responseText);
                        $(processing).replaceWith("Erro ao processar o arquivo XML");
                        $('#upload-errors').append('<h2>Errors from file: ' + original + '</h2>')
                        if (resp.errors) {
                            $('#upload-errors').append('<li>'+ JSON.stringify(resp.errors) + '</li><hr />');
                        } else {
                            $('#upload-errors').append('<li>'+ resp.responseText + '</li><hr />');
                        }
                        $('#validation-errors').show();
                    }
                }
            });
        };

        var $fileUpload = $('#resumable-browse');
        var $fileUploadDrop = $('#resumable-drop');
        var $uploadList = $("#file-upload-list");

        if ($fileUpload.length > 0 && $fileUploadDrop.length > 0) {
            var resumable = resumable({
                // Use chunk size that is smaller than your maximum limit due a resumable issue
                // https://github.com/23/resumable.js/issues/51
                chunkSize: 1 * 1024 * 1024, // 1MB
                simultaneousUploads: 2,
                testChunks: false,
                throttleProgressCallbacks: 1,
                // Get the url from data-url tag
                target: $fileUpload.data('url'),
                // Append token to the request - required for web routes
                query:{_token : '{{ csrf_token() }}' },
                fileType: ['xml'],
                fileTypeErrorCallback: function(){ alert("Só é permitido fazer upload de arquivos XML.") }
            });

        // Resumable.js isn't supported, fall back on a different method
            if (!resumable.support) {
                $('#resumable-error').show();
            } else {
                // Show a place for dropping/selecting files
                $fileUploadDrop.show();
                resumable.assignDrop($fileUpload[0]);
                resumable.assignBrowse($fileUploadDrop[0]);

                // Handle file add event
                resumable.on('fileAdded', function (file) {
                    // Show progress pabr
                    $uploadList.show();
                    // Show pause, hide resume
                    $('.resumable-progress .progress-resume-link').hide();
                    $('.resumable-progress .progress-pause-link').show();
                    // Add the file to the list
                    $uploadList.append('<li class="resumable-file-' + file.uniqueIdentifier + '">Uploading <span class="resumable-file-name"></span> <span class="resumable-file-progress"></span>');
                    $('.resumable-file-' + file.uniqueIdentifier + ' .resumable-file-name').html(file.fileName);
                    // Actually start the or drop here upload
                    resumable.upload();
                });
                resumable.on('fileSuccess', function (file, message) {
                    // Reflect that the file upload has completed
                    message = $.parseJSON(message);
                    let button = $("<button class='proccessData' data-file-path='" + message.path + "' data-file-name='" + message.name + "' data-original-name='" + file.fileName + "'>Process</button>'");
                    button.on('click', proccessData);
                    $('.resumable-file-' + file.uniqueIdentifier + ' .resumable-file-progress').html('(completed)').append(button);
                });
                resumable.on('fileError', function (file, message) {
                    // Reflect that the file upload has resulted in error
                    $('.resumable-file-' + file.uniqueIdentifier + ' .resumable-file-progress').html('(file could not be uploaded: ' + message + ')');
                });
                resumable.on('fileProgress', function (file) {
                    // Handle progress for both the file and the overall upload
                    $('.resumable-file-' + file.uniqueIdentifier + ' .resumable-file-progress').html(Math.floor(file.progress() * 100) + '%');
                    $('.progress-bar').css({width: Math.floor(resumable.progress() * 100) + '%'});
                });
            }

        }

    </script>
</html>
