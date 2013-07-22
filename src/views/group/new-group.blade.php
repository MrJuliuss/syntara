@extends('syntara::layouts.dashboard.master')

@section('content')
{{ Breadcrumbs::create(array(array('title' => 'Groups', 'link' => "dashboard/groups", 'icon' => 'icon-list-alt'), array('title' => 'New group', 'link' => URL::current(), 'icon' => 'icon-plus-sign'))); }}

<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <section class="module">
                <div class="module-head">
                    <b>New group</b>
                </div>
                <div class="module-body">
                    <form class="form-horizontal" id="create-group-form" method="PUT">
                        <div class="span6">
                            <div class="control-group">
                               <label class="control-label">Group name</label>
                               <div class="controls">
                                   <input class="span12" type="text" id="groupName" name="groupName">
                               </div>
                           </div>
                        </div>
                        <div class="span6">
                            <div class="control-group">
                                <label class="control-label">Permissions</label>
                                <div class="controls">
                                    <input class="span12" type="text" id="groupPermission" name="groupPermission">
                                </div>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="controls">
                                <button id="create-group" class="btn btn-primary">Create</button>
                            </div>   
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>
</div>
@stop