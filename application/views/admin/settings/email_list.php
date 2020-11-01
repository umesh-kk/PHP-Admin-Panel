<section class="content">
    <ol class="breadcrumb breadcrumb-col-blue">
        <li><a href="<?= ADMIN_URL ?>"><i class="material-icons">home</i> Home</a></li>
        <li class="active"> Email Templates</li>
    </ol>
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>Email Templates</h2>
                    </div>
                    <form id="advancedForm" action="<?= ADMIN_URL ?>settings">
                        <input type="text" id="reload" value="0" style="display: none">
                        <input type="hidden" name="sort_by" value="<?= isset($sort_by) ? $sort_by : '' ?>">
                        <input type="hidden" name="sort_dir" value="<?= isset($sort_dir) ? $sort_dir : '' ?>">

                        <div class="body table-responsive no-padding-top" id="loadData">
                            <table class="table table-striped table-bordered dataTable">
                                <thead>
                                    <tr>
                                        <th>
                                            <div class="table-check">
                                                <input type="checkbox" id="check_all" class="filled-in chk-col-blue check-all" <?= $records->count() > 0 ? '' : 'disabled' ?>/>
                                                <label for="check_all"></label>
                                            </div>    
                                        </th>
                                        <th >Title</th>                                        
                                        <th style="width: 100px"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($records->count() > 0) : ?>
                                        <?php foreach ($records as $key => $record) : ?>
                                            <tr>
                                                <th scope="row">
                                                    <div class="table-check">
                                                        <input type="checkbox" id="column_<?= $key ?>" class="filled-in chk-col-blue check-single" value="<?= $record->id ?>" />
                                                        <label for="column_<?= $key ?>"></label>
                                                    </div> 
                                                </th>
                                               
                                                <td><?= $record->email_title ?></td>
                                                <td>
                                                    <a href="<?= ADMIN_URL ?>settings/edit/<?= $record->id ?>" class="btn bg-blue waves-effect" title="Edit"><i class="material-icons">edit</i></a>

                                                    <a href="<?= ADMIN_URL ?>settings/delete/<?= $record->id ?>" class="btn btn-danger waves-effect delete-btn" title="Delete"><i class="material-icons">delete_sweep</i></a>


                                                    <!-- <?php if ($record->active == 'Y') : ?>
                                                        <a href="<?= ADMIN_URL ?>settings/block/<?= $record->id ?>" class="btn btn-success waves-effect block-btn" title="Click to deactivate"><i class="material-icons">stars</i></a>
                                                    <?php else : ?>
                                                        <a href="<?= ADMIN_URL ?>settings/unblock/<?= $record->id ?>" class="btn bg-grey waves-effect block-btn" title="Click to activate"><i class="material-icons">block</i></a>
                                                    <?php endif ?> -->
                                                </td>
                                            </tr>
                                        <?php endforeach ?>   
                                    <?php else : ?>
                                        <tr>
                                            <td colspan="6" class="text-center"> No Emails found.</td>
                                        </tr>    
                                    <?php endif ?>     
                                </tbody>
                            </table>
                        </div>
                    </form>    
                </div>
            </div>
        </div>
    </div>
</section> 
<script type="text/javascript">
function loadData() {
    var search = $('#search').val();
    $.get('<?= ADMIN_URL ?>settings?isAjax=1&search='+search, function(data) {
        console.log(data);
        $('#loadData').html(data);
        $('#reload').val('1');
    });
}

$(function () {

    $(document).on('keyup','#search', $.debounce( 250, function(e) {
        loadData();
    }));

    if($('#reload').val() == '1') {
        loadData();
    }
});
</script>
