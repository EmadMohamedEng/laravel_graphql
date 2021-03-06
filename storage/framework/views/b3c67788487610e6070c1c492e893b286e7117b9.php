<?php $__env->startSection('page_title'); ?>
View Content
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="row">
    <div class="col-ms-12">
        <div class="embed-responsive embed-responsive-16by9">
            <div class="">
                <div id="elfinder"></div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script data-main="./main.default.js" src="//cdnjs.cloudflare.com/ajax/libs/require.js/2.3.2/require.min.js"></script>

<script>
    console.log($('meta[name="token"]').attr('content'))
    define('elFinderConfig', {
        // elFinder options (REQUIRED)
        // Documentation for client options:
        // https://github.com/Studio-42/elFinder/wiki/Client-configuration-options
        defaultOpts: {
            url: '<?php echo e(url("admin/elfinder")); ?>' ,// connector URL (REQUIRED)
            customHeaders : {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            customData: {
                '_token': $('meta[name="csrf-token"]').attr('content')
            }
            , commandsOptions: {
                edit: {
                    extraOptions: {
                        // set API key to enable Creative Cloud image editor
                        // see https://console.adobe.io/
                        creativeCloudApiKey: '',
                        // browsing manager URL for CKEditor, TinyMCE
                        // uses self location with the empty value
                        managerUrl: ''
                    }
                }
                , quicklook: {
                    // to enable preview with Google Docs Viewer
                    googleDocsMimes: ['application/pdf', 'image/tiff', 'application/vnd.ms-office', 'application/msword', 'application/vnd.ms-word', 'application/vnd.ms-excel', 'application/vnd.ms-powerpoint', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet']
                }
            }
            // bootCalback calls at before elFinder boot up
            , bootCallback: function (fm, extraObj) {
                /* any bind functions etc. */
                fm.bind('init', function () {
                    // any your code
                });
                // for example set document.title dynamically.
                var title = document.title;
                fm.bind('open', function () {
                    var path = '',
                            cwd = fm.cwd();
                    if (cwd) {
                        path = fm.path(cwd.hash) || null;
                    }
                    document.title = path ? path + ':' + title : title;
                }).bind('destroy', function () {
                    document.title = title;
                });
            }
        },
        managers: {
            // 'DOM Element ID': { /* elFinder options of this DOM Element */ }
            'elfinder': {}
        }
    });


</script>
<script>
    $(document).ready(function () {
        $('#file_manager').addClass('active');
        $('#file_elfinder').addClass('active');
    });
</script>
<style>
    .elfinder-quicklook{
        top:40px!important;
    }
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp7.3\htdocs\ivas_template_laravel5.8\resources\views/elfinder/filemanager.blade.php ENDPATH**/ ?>