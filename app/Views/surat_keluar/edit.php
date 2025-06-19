<?= $this->extend('layouts/master') ?>

<?= $this->section('main-content') ?>
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>Edit Surat</h3>
            </div>
            <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url("/") ?>">
                            <svg class="stroke-icon">
                                <use href="<?= base_url() ?>/assets/svg/icon-sprite.svg#stroke-home"></use>
                            </svg></a></li>
                    <li class="breadcrumb-item">Surat</li>
                    <li class="breadcrumb-item active">Edit Surat</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- Container-fluid starts-->
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <?php if (session()->getFlashdata('swal_success')) : ?>
                <meta name="swal-success" content="<?= session()->getFlashdata('swal_success') ?>">
            <?php endif; ?>

            <?php if (session()->getFlashdata('swal_error')) : ?>
                <meta name="swal-error" content="<?= session()->getFlashdata('swal_error') ?>">
            <?php endif; ?>

            <?php if (session()->getFlashdata('validation_errors')) : ?>
                <meta name="swal-validation-errors" content='<?= json_encode(session()->getFlashdata('validation_errors')) ?>'>
            <?php endif; ?>

            <!-- Untuk pesan error -->
            <?php if (session()->getFlashdata('alert')): ?>
                <div class="error" data-error="<?= session()->getFlashdata('alert') ?>"></div>
            <?php endif; ?>

            <div class="card">
                <div class="card-header">
                    <h5>Edit Surat</h5>
                </div>
                <?php foreach ($suratkeluars as $surat) : ?>
                    <form class="form theme-form" action="<?= base_url('suratkeluar/update/' . $surat->id_surat_keluar . '/') ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field(); ?>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Nomor Surat</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="text" id="no_surat" name="no_surat" placeholder="Nomor Surat" value="<?= $surat->no_surat; ?>" required>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Tanggal Surat</label>
                                        <div class="col-sm-9">
                                            <input class="form-control digits" type="date" id="tgl_surat" name="tgl_surat" value="<?= $surat->tgl_surat; ?>" required>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Lampiran</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="text" id="lampiran" name="lampiran" placeholder="Lampiran" value="<?= $surat->lampiran; ?>" required>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <small class="ml-3" style="color:red; font-size:17px;">* File lampiran opotional, diisi jika ada lampiran*</small>
                                        <label class="col-sm-3 col-form-label">File Lampiran</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="file" id="file_lampiran" name="file_lampiran">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Perihal</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="text" id="perihal" name="perihal" placeholder="Perihal" value="<?= $surat->perihal; ?>" required>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Prioritas</label>
                                        <div class="col-sm-9">
                                            <select class="js-example-basic-single col-sm-12" id="prioritas" name="prioritas">
                                                <option value="">-- Pilih Prioritas --</option>
                                                <option value="biasa">Biasa</option>
                                                <option value="segera">Segera</option>
                                                <option value="mendesak">Mendesak</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Klien</label>
                                        <div class="col-sm-9">
                                            <select class="js-example-basic-single col-sm-12" id="klien_id" name="klien_id">
                                                <option value="">-- Pilih Klien --</option>
                                                <?php foreach ($kliens as $klien): ?>
                                                    <option value="<?= $klien->id_klien ?>" <?= ($klien->id_klien == $surat->klien_id) ? 'selected' : '' ?> data-nama="<?= $klien->nama_klien ?>">
                                                        <?= $klien->no_klien . ' - ' . $klien->nama_klien ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <input type="hidden" name="nama_klien" id="nama_klien">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Tempat</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="text" id="tempat" name="tempat" placeholder="Tempat" value="<?= $surat->tempat; ?>">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Penerbit</label>
                                        <div class="col-sm-9">
                                            <select class="js-example-basic-single col-sm-12" id="penerbit_id" name="penerbit_id" required>
                                                <option value="">-- Pilih Penerbit --</option>
                                                <?php foreach ($pejabats as $pejabat): ?>
                                                    <option value="<?= $pejabat->id_karyawan ?>" <?= ($pejabat->id_karyawan == $surat->penerbit_id) ? 'selected' : '' ?>>
                                                        <?= $pejabat->nama_lengkap . ' (' . $pejabat->nama_jabatan . ')'; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Konten Surat</label>
                                        <div class="col-sm-9">
                                            <textarea name="konten" id="konten" class="form-control"><?= $surat->konten; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <div class="col-sm-9 offset-sm-3">
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                        </div>
                    </form>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
<!-- Container-fluid Ends-->

<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script src="https://cdn.ckeditor.com/ckeditor5/41.3.1/super-build/ckeditor.js"></script>
<script>
    // get nama klien
    $('#klien_id').on('change', function() {
        var namaKlien = $(this).find(':selected').data('nama');
        $('#nama_klien').val(namaKlien);
    });
</script>

<!-- <script src="https://cdn.ckeditor.com/ckeditor5/35.0.1/classic/ckeditor.js"></script> -->
<script>
    // This sample still does not showcase all CKEditor&nbsp;5 features (!)
    // Visit https://ckeditor.com/docs/ckeditor5/latest/features/index.html to browse all the features.
    CKEDITOR.ClassicEditor.create(document.getElementById("konten"), {
        // https://ckeditor.com/docs/ckeditor5/latest/features/toolbar/toolbar.html#extended-toolbar-configuration-format
        toolbar: {
            items: [
                'findAndReplace', 'selectAll', '|',
                'heading', '|',
                'bold', 'italic', 'strikethrough', 'underline', '|',
                'bulletedList', 'numberedList', 'todoList', '|',
                'fontSize', 'fontFamily', '|',
                'alignment', '|',
                'ckfinder', '|',
                'undo', 'redo',
            ],
            shouldNotGroupWhenFull: true
        },
        // Changing the language of the interface requires loading the language file using the <script> tag.
        // language: 'es',
        list: {
            properties: {
                styles: true,
                startIndex: true,
                reversed: true
            }
        },
        // https://ckeditor.com/docs/ckeditor5/latest/features/headings.html#configuration
        heading: {
            options: [{
                    model: 'paragraph',
                    title: 'Paragraph',
                    class: 'ck-heading_paragraph'
                },
                {
                    model: 'heading1',
                    view: 'h1',
                    title: 'Heading 1',
                    class: 'ck-heading_heading1'
                },
                {
                    model: 'heading2',
                    view: 'h2',
                    title: 'Heading 2',
                    class: 'ck-heading_heading2'
                },
                {
                    model: 'heading3',
                    view: 'h3',
                    title: 'Heading 3',
                    class: 'ck-heading_heading3'
                },
                {
                    model: 'heading4',
                    view: 'h4',
                    title: 'Heading 4',
                    class: 'ck-heading_heading4'
                },
                {
                    model: 'heading5',
                    view: 'h5',
                    title: 'Heading 5',
                    class: 'ck-heading_heading5'
                },
                {
                    model: 'heading6',
                    view: 'h6',
                    title: 'Heading 6',
                    class: 'ck-heading_heading6'
                }
            ]
        },
        // https://ckeditor.com/docs/ckeditor5/latest/features/editor-placeholder.html#using-the-editor-configuration
        placeholder: '',
        // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-family-feature
        fontFamily: {
            options: [
                'default',
                'Arial, Helvetica, sans-serif',
                'Courier New, Courier, monospace',
                'Georgia, serif',
                'Lucida Sans Unicode, Lucida Grande, sans-serif',
                'Tahoma, Geneva, sans-serif',
                'Times New Roman, Times, serif',
                'Trebuchet MS, Helvetica, sans-serif',
                'Verdana, Geneva, sans-serif'
            ],
            supportAllValues: true
        },
        // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-size-feature
        fontSize: {
            options: [10, 12, 14, 'default', 18, 20, 22],
            supportAllValues: true
        },
        // Be careful with the setting below. It instructs CKEditor to accept ALL HTML markup.
        // https://ckeditor.com/docs/ckeditor5/latest/features/general-html-support.html#enabling-all-html-features
        htmlSupport: {
            allow: [{
                name: /.*/,
                attributes: true,
                classes: true,
                styles: true
            }]
        },
        // Be careful with enabling previews
        // https://ckeditor.com/docs/ckeditor5/latest/features/html-embed.html#content-previews
        htmlEmbed: {
            showPreviews: true
        },
        // https://ckeditor.com/docs/ckeditor5/latest/features/link.html#custom-link-attributes-decorators
        link: {
            decorators: {
                addTargetToExternalLinks: true,
                defaultProtocol: 'https://',
                toggleDownloadable: {
                    mode: 'manual',
                    label: 'Downloadable',
                    attributes: {
                        download: 'file'
                    }
                }
            }
        },
        // uploadImage: {
        //     types: ['jpeg', 'png', 'gif', 'bmp', 'webp', 'jpg'],
        //     previewsInData: true
        // },
        // ckfinder: {
        //     uploadUrl: "<?= base_url('klien/upload') ?>"
        // },
        // https://ckeditor.com/docs/ckeditor5/latest/features/mentions.html#configuration
        mention: {
            feeds: [{
                marker: '@',
                feed: [
                    '@apple', '@bears', '@brownie', '@cake', '@cake', '@candy', '@canes', '@chocolate', '@cookie', '@cotton', '@cream',
                    '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake', '@gingerbread', '@gummi', '@ice', '@jelly-o',
                    '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum', '@pudding', '@sesame', '@snaps', '@soufflé',
                    '@sugar', '@sweet', '@topping', '@wafer'
                ],
                minimumCharacters: 1
            }]
        },
        // The "superbuild" contains more premium features that require additional configuration, disable them below.
        // Do not turn them on unless you read the documentation and know how to configure them and setup the editor.
        removePlugins: [
            // These two are commercial, but you can try them out without registering to a trial.
            // 'ExportPdf',
            // 'ExportWord',
            'AIAssistant',
            'CKBox',
            'CKFinder',
            'EasyImage',
            // This sample uses the Base64UploadAdapter to handle image uploads as it requires no configuration.
            // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/base64-upload-adapter.html
            // Storing images as Base64 is usually a very bad idea.
            // Replace it on production website with other solutions:
            // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/image-upload.html
            // 'Base64UploadAdapter',
            'MultiLevelList',
            'RealTimeCollaborativeComments',
            'RealTimeCollaborativeTrackChanges',
            'RealTimeCollaborativeRevisionHistory',
            'PresenceList',
            'Comments',
            'TrackChanges',
            'TrackChangesData',
            'RevisionHistory',
            'Pagination',
            'WProofreader',
            // Careful, with the Mathtype plugin CKEditor will not load when loading this sample
            // from a local file system (file://) - load this site via HTTP server if you enable MathType.
            'MathType',
            // The following features are part of the Productivity Pack and require additional license.
            'SlashCommand',
            'Template',
            'DocumentOutline',
            'FormatPainter',
            'TableOfContents',
            'PasteFromOfficeEnhanced',
            'CaseChange'
        ]

    });
    RemoveFormat: [
        'paragraph'

    ]
</script>

<?= $this->endSection() ?>