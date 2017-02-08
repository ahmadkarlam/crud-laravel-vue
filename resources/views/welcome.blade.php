<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta id="token" name="_token" content="{{ csrf_token() }}">

    <title>Laravel & VueJS</title>

    <link rel="stylesheet" href="/css/app.css">
</head>
<body>

<div class="container" style="margin-top: 10px">
    <div class="row">
        <div class="col-lg-12" id="app">
            <button class="btn btn-primary" @click='showCreateModal'>Create user</button>
            <nav aria-label="Page navigation" class="pull-right">
                <ul class="pagination">
                    <li>
                        <button :disabled="!paging.prev_page_url" aria-label="Previous" @click='getUser(paging.prev_page_url)'>
                            <span aria-hidden="true">&laquo;</span>
                        </button>
                    </li>
                    <li>
                        Page @{{ paging.current_page }} of @{{ paging.last_page }}
                    </li>
                    <li>
                        <button :disabled="!paging.next_page_url" aria-label="Next" @click='getUser(paging.next_page_url)'>
                            <span aria-hidden="true">&raquo;</span>
                        </button>
                    </li>
                </ul>
            </nav>
            <div class="col-lg-12">
                <div class="col-lg-10">
                    <input type="text" class="form-control" v-model="querySearch" placeholder="Search" @keyup='getUser()'>
                </div>
                <div class="col-lg-2">
                    <button class="btn btn-default btn-block" @click='querySearch = ""; getUser()'>Clear</button>
                </div>
                <div class="clearfix">&nbsp;</div>
            </div>
            <table class="table">
            	<thead>
            		<tr>
            			<td>Id</td>
            			<td>Name</td>
            			<td>Email</td>
            			<td>Action</td>
            		</tr>
            	</thead>
            	<tbody>
            		<tr v-for='user in users'>
                        <td>@{{ user.id }}</td>
            			<td>@{{ user.name }}</td>
            			<td>@{{ user.email }}</td>
            			<td>
            				<button class="btn btn-warning" @click='showEditModal(user.id)'>
            					Edit
            				</button>
            				<button class='btn btn-danger' @click='deleteUser(user.id)'>
            					Delete
            				</button>
            			</td>
            		</tr>
            	</tbody>
            </table>
            <div class="modal fade" tabindex="-1" role="dialog" id="editModal">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Edit user</h4>
                        </div>
                        <div class="modal-body">
                            <form class="form-horizontal">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Name</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="name" v-model='user.name' class='form-control'>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Email</label>
                                    <div class="col-sm-8">
                                        <input type="email" name="name" v-model='user.email' class='form-control'>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Password</label>
                                    <div class="col-sm-8">
                                        <input type="password" name="password" v-model='user.password' class='form-control'>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" @click='update()'>Save changes</button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
            <div class="modal fade" tabindex="-1" role="dialog" id="createModal">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Create new user</h4>
                        </div>
                        <div class="modal-body">
                            <form class="form-horizontal">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Name</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="name" v-model='user.name' class='form-control'>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Email</label>
                                    <div class="col-sm-8">
                                        <input type="email" name="email" v-model='user.email' class='form-control'>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Password</label>
                                    <div class="col-sm-8">
                                        <input type="password" name="password" v-model='user.password' class='form-control'>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" @click='create'>Save changes</button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
        </div>
    </div>
</div>
<script>
    window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
    ]); ?>
</script>
<script src="/js/app.js"></script>
</body>
</html>
