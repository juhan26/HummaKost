@extends('app')
@section('content')
    <form action="{{ route('facilities.store') }}" class="dropzone" id="imageDropZone" method="POST"
        enctype="multipart/form-data">
        @csrf
        <button type="submit" id="submit-all" class="btn btn-primary"
            style="position: absolute; bottom: 0; right: 0; margin: 10px">Simpan
            Gambar</button>
    </form>

    <script>
        Dropzone.autoDiscover = false;

        const myDropzone = new Dropzone("#imageDropZone", {
            paramName: "photo",
            maxFilesize: 2,
            acceptedFiles: ".jpeg,.jpg,.png",
            autoProcessQueue: false,
            addRemoveLinks: true,
            dictDefaultMessage: "Letakkan file di sini atau klik untuk mengunggah",
            parallelUploads: 10,
            init: function() {
                const submitButton = document.querySelector("#submit-all");
                const dropzoneInstance = this;

                submitButton.addEventListener("click", function(e) {
                    e.preventDefault();
                    e.stopPropagation();

                    if (dropzoneInstance.getQueuedFiles().length > 0) {
                        dropzoneInstance
                            .processQueue();
                    } else {
                        dropzoneInstance.submitForm();
                    }
                });

                this.on("sendingmultiple", function(data, xhr, formData) {
                    formData.append("_token", "{{ csrf_token() }}");
                    formData.append("name", document.querySelector('input[name="name"]').value);
                    formData.append("description", document.querySelector(
                        'textarea[name="description"]').value);
                });

                this.on("queuecomplete", function() {
                    dropzoneInstance.submitForm();
                });
            },
            submitForm: function() {
                document.querySelector("#imageDropZone").submit();
            }
        });
    </script>
@endsection
