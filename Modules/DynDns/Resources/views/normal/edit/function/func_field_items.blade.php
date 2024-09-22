@php
    $group_id = Arr::get($row,$func->field_id);
    $groupItems = md::find_all("sys_field_items","field_group_id='$group_id' and parent_id=0");
    $types = App\Model\FieldItem::getType();
    $masks = App\Model\FieldItem::getMask();
@endphp
<div class="widget meta-boxes">
    <textarea name="group_items" id="custom_fields" class="form-control hiddens"
        style="display: nones !important;"></textarea>
    <textarea name="deleted_items" id="deleted_items" class="form-control hiddens"
        style="display: nones !important;"></textarea>
    <div class="widget-title">
        <h4>
            <span> Field items information</span>
        </h4>
    </div>
    <div class="widget-body">
        <div class="custom-fields-list">
            <div class="nestable-group">
                <div class="add-new-field">
                    <ul class="row field-table-header clearfix">
                        <li class="col-4 list-group-item w-bold">Label</li>
                        <li class="col-4 list-group-item w-bold">Field name</li>
                        <li class="col-4 list-group-item w-bold">Field type</li>
                    </ul>
                    <div class="clearfix"></div>
                    <ul class="sortable-wrapper edit-field-group-items field-group-items ui-sortable" id="custom_field_group_items">
                        @if(count($groupItems)>0)
                            @foreach ($groupItems as $groupItem )
                            <li class="ui-sortable-handle " data-position="{{$loop->index+1}}" style="position: relative; left: 0px; top: 0px;">
                                <div class="field-column">
                                    <div class="row">
                                        <div class="text col-4 field-label">{{$groupItem->title}}</div>
                                        <div class="text col-4 field-slug">{{$groupItem->slug}}</div>
                                        <div class="text col-4 field-type">{{$groupItem->type}} {{$groupItem->mask}}</div>
                                    </div>
                                    <a class="show-item-details" title="" href="javascript:;"><i class="fa fa-angle-down"></i></a>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="item-details" data-id="{{$groupItem->id}}">
                                    <div class="line" data-option="title">
                                        <div class="col-3">
                                            <h5>Label</h5>
                                            <p>This is the title of field item. It will be shown on edit pages.</p>
                                        </div>
                                        <div class="col-9">
                                            <h5>Label</h5>
                                            <input type="text" class="form-control" placeholder="" value="{{$groupItem->title}}">
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="line" data-option="slug">
                                        <div class="col-3">
                                            <h5>Field name</h5>
                                            <p>The alias of field item. Accepted numbers, characters and underscore.</p>
                                        </div>
                                        <div class="col-9">
                                            <h5>Field name</h5>
                                            <input type="text" class="form-control" placeholder="" value="{{$groupItem->slug}}">
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="line" data-option="type">
                                        <div class="col-3">
                                            <h5>Field type</h5>
                                            <p>Please select the type of this field.</p>
                                        </div>
                                        <div class="col-9">
                                            <h5>Field type</h5>
                                            <select class="form-control change-field-type">
                                                @foreach($types as $key=>$value)
                                                <option value="{{$key}}" {{$groupItem->type==$key?'selected':''}}>{{$value}}</option>
                                                @endforeach
                                                {{-- <optgroup label="Basic">
                                                    <option value="text" selected="selected">Text field</option>
                                                    <option value="textarea">Textarea</option>
                                                    <option value="number">Number</option>
                                                    <option value="email">Email</option>
                                                    <option value="password">Password</option>
                                                </optgroup>
                                                <optgroup label="Content">
                                                    <option value="wysiwyg">WYSIWYG editor</option>
                                                    <option value="image">Image</option>
                                                    <option value="file">File</option>
                                                </optgroup>
                                                <optgroup label="Choices">
                                                    <option value="select">Select</option>
                                                    <option value="checkbox">Checkbox</option>
                                                    <option value="radio">Radio</option>
                                                </optgroup>
                                                <optgroup label="Other">
                                                    <option value="repeater">Repeater</option>
                                                </optgroup> --}}
                                            </select>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="line" data-option="mask">
                                        <div class="col-3">
                                            <h5>Field mask</h5>
                                            <p>Please select the type of this field.</p>
                                        </div>
                                        <div class="col-9">
                                            <h5>Field mask</h5>
                                            <select class="form-control change-field-type">
                                                @isset($masks[$groupItem->type])
                                                @foreach($masks[$groupItem->type] as $mask)
                                                <option value="{{@$mask['mask']}}" {{@$groupItem->mask==@$mask['mask']?'selected':''}}>{{$mask['title']}}</option>
                                                @endforeach
                                                @endisset

                                                {{-- <optgroup label="Basic">
                                                    <option value="text" selected="selected">Text field</option>
                                                    <option value="textarea">Textarea</option>
                                                    <option value="number">Number</option>
                                                    <option value="email">Email</option>
                                                    <option value="password">Password</option>
                                                </optgroup>
                                                <optgroup label="Content">
                                                    <option value="wysiwyg">WYSIWYG editor</option>
                                                    <option value="image">Image</option>
                                                    <option value="file">File</option>
                                                </optgroup>
                                                <optgroup label="Choices">
                                                    <option value="select">Select</option>
                                                    <option value="checkbox">Checkbox</option>
                                                    <option value="radio">Radio</option>
                                                </optgroup>
                                                <optgroup label="Other">
                                                    <option value="repeater">Repeater</option>
                                                </optgroup> --}}
                                            </select>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="line" data-option="instructions">
                                        <div class="col-3">
                                            <h5>Field instructions</h5>
                                            <p>HThe instructions guide for user easier know what they need to input.</p>
                                        </div>
                                        <div class="col-9">
                                            <h5>Field instructions</h5>
                                            <textarea class="form-control" rows="5"></textarea>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="options">

                                        @if($groupItem->type=="repeater")
                                        @php
                                            $groupSubItems = md::find_all("sys_field_items","parent_id='$groupItem->id'");
                                        @endphp
                                        <div class="line" data-option="repeater">
                                            <div class="col-3">
                                                <h5>Repeater</h5>
                                            </div>
                                            <div class="col-9">
                                                <h5>Repeater</h5>
                                                <div class="add-new-field">
                                                    <ul class="row list-group field-table-header clearfix">
                                                        <li class="col-4 list-group-item w-bold">Label</li>
                                                        <li class="col-4 list-group-item w-bold">Field name</li>
                                                        <li class="col-4 list-group-item w-bold">Field type</li>
                                                    </ul>
                                                    <div class="clearfix"></div>
                                                    <ul class="sortable-wrapper edit-field-group-items field-group-items ui-sortable">
                                                        @if(count($groupSubItems)>0)
                                                        @foreach ($groupSubItems as $subItem)
                                                        <li class="ui-sortable-handle" data-position="1">
                                                            <div class="field-column">
                                                                <div class="row">
                                                                    <div class="text col-4 field-label">{{$subItem->title}}</div>
                                                                    <div class="text col-4 field-slug">{{$subItem->slug}}
                                                                    </div>
                                                                    <div class="text col-4 field-type">{{$subItem->type}}</div>
                                                                </div>
                                                                <a class="show-item-details" title="" href="javascript:;"><i class="fa fa-angle-down"></i></a>
                                                                <div class="clearfix"></div>
                                                            </div>
                                                            <div class="item-details repeater" data-id="{{$subItem->id}}">
                                                                <div class="line" data-option="title">
                                                                    <div class="col-3">
                                                                        <h5>Label</h5>
                                                                        <p>This is the title of field item. It will be shown
                                                                            on edit pages.</p>
                                                                    </div>
                                                                    <div class="col-9">
                                                                        <h5>Label</h5>
                                                                        <input type="text" class="form-control"
                                                                            placeholder="" value="{{$subItem->title}}">
                                                                    </div>
                                                                    <div class="clearfix"></div>
                                                                </div>
                                                                <div class="line" data-option="slug">
                                                                    <div class="col-3">
                                                                        <h5>Field name</h5>
                                                                        <p>The alias of field item. Accepted numbers,
                                                                            characters and underscore.</p>
                                                                    </div>
                                                                    <div class="col-9">
                                                                        <h5>Field name</h5>
                                                                        <input type="text" class="form-control"
                                                                            placeholder="" value="{{$subItem->slug}}">
                                                                    </div>
                                                                    <div class="clearfix"></div>
                                                                </div>
                                                                <div class="line" data-option="type">
                                                                    <div class="col-3">
                                                                        <h5>Field type</h5>
                                                                        <p>Please select the type of this field.</p>
                                                                    </div>
                                                                    <div class="col-9">
                                                                        <h5>Field type</h5>
                                                                        <select class="form-control change-field-type">
                                                                            @foreach($types as $key=>$value)
                                                                            <option value="{{$key}}" {{$subItem->type==$key?'selected':''}}>{{$value}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="clearfix"></div>
                                                                </div>
                                                                <div class="line" data-option="mask">
                                                                    <div class="col-3">
                                                                        <h5>Field mask</h5>
                                                                        <p>Please select the type of this field.</p>
                                                                    </div>
                                                                    <div class="col-9">
                                                                        <h5>Field mask</h5>
                                                                        <select class="form-control change-field-type">
                                                                            @isset($masks[$subItem->type])
                                                                            @foreach($masks[$subItem->type] as $mask)
                                                                            <option value="{{@$mask['mask']}}" {{@$subItem->mask==@$mask['mask']?'selected':''}}>{{$mask['title']}}</option>
                                                                            @endforeach
                                                                            @endisset
                                                                        </select>
                                                                    </div>
                                                                    <div class="clearfix"></div>
                                                                </div>
                                                                <div class="line" data-option="instructions">
                                                                    <div class="col-3">
                                                                        <h5>Field instructions</h5>
                                                                        <p>HThe instructions guide for user easier know what
                                                                            they need to input.</p>
                                                                    </div>
                                                                    <div class="col-9">
                                                                        <h5>Field instructions</h5>
                                                                        <textarea class="form-control" rows="5"></textarea>
                                                                    </div>
                                                                    <div class="clearfix"></div>
                                                                </div>
                                                                <div class="options">
                                                                    <div class="line" data-option="defaultvalue">
                                                                        <div class="col-3">
                                                                            <h5>Default value</h5>
                                                                            <p>The default value of field when leave it
                                                                                blank</p>
                                                                        </div>
                                                                        <div class="col-9">
                                                                            <h5>Default value</h5>
                                                                            <input type="text" class="form-control"
                                                                                placeholder="" value="">
                                                                        </div>
                                                                        <div class="clearfix"></div>
                                                                    </div>

                                                                    <div class="line" data-option="placeholdertext">
                                                                        <div class="col-3">
                                                                            <h5>Placeholder</h5>
                                                                            <p>Placeholder text</p>
                                                                        </div>
                                                                        <div class="col-9">
                                                                            <h5>Placeholder</h5>
                                                                            <input type="text" class="form-control"
                                                                                placeholder="" value="">
                                                                        </div>
                                                                        <div class="clearfix"></div>
                                                                    </div>
                                                                </div>

                                                                <div class="text-right p10">
                                                                    <a class="btn red btn-remove" title="" href="javascript:;">Remove
                                                                        field</a>
                                                                    <a class="btn blue btn-close-field" title=""
                                                                        href="javascript:;">Close field</a>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        @endforeach
                                                        @endif

                                                    </ul>
                                                    <div class="text-right pt10">
                                                        <a class="btn btn-info btn-add-field" href="javascript:;">Add field</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>

                                        <div class="line" data-option="buttonlabel">
                                            <div class="col-3">
                                                <h5>Button for repeater</h5>
                                            </div>
                                            <div class="col-9">
                                                <h5>Button for repeater</h5>
                                                <input type="text" class="form-control" placeholder="Add new" value="">
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                        @else
                                        <div class="line" data-option="defaultvaluetextarea">
                                            <div class="col-3">
                                                <h5>Default value</h5>
                                                <p>The default value of field when leave it blank</p>
                                            </div>
                                            <div class="col-9">
                                                <h5>Default value</h5>
                                                <textarea class="form-control" rows="5"></textarea>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="line" data-option="wysiwygtoolbar">
                                            <div class="col-3">
                                                <h5>Toolbar</h5>
                                                <p>The toolbar when use editor</p>
                                            </div>
                                            <div class="col-9">
                                                <h5>Toolbar</h5>
                                                <select class="form-control">
                                                    <option value="basic">Basic</option>
                                                    <option value="full">Full</option>
                                                </select>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="text-right p10">
                                        <a class="btn red btn-remove" title="" href="javascript:;">Remove field</a>
                                        <a class="btn blue btn-close-field" title="" href="javascript:;">Close field</a>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        @else
                        <li class="ui-sortable-handle " data-position="1" style="position: relative; left: 0px; top: 0px;">
                            <div class="field-column">
                                <div class="row">
                                    <div class="text col-4 field-label">Tiêu đề</div>
                                    <div class="text col-4 field-slug">guide_title</div>
                                    <div class="text col-4 field-type">wysiwyg</div>
                                </div>
                                <a class="show-item-details" title="" href="javascript:;"><i
                                        class="fa fa-angle-down"></i></a>
                                <div class="clearfix"></div>
                            </div>
                            <div class="item-details">
                                <div class="line" data-option="title">
                                    <div class="col-3">
                                        <h5>Label</h5>
                                        <p>This is the title of field item. It will be shown on edit pages.</p>
                                    </div>
                                    <div class="col-9">
                                        <h5>Label</h5>
                                        <input type="text" class="form-control" placeholder="" value="New field">
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="line" data-option="slug">
                                    <div class="col-3">
                                        <h5>Field name</h5>
                                        <p>The alias of field item. Accepted numbers, characters and underscore.</p>
                                    </div>
                                    <div class="col-9">
                                        <h5>Field name</h5>
                                        <input type="text" class="form-control" placeholder="" value="">
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="line" data-option="type">
                                    <div class="col-3">
                                        <h5>Field type</h5>
                                        <p>Please select the type of this field.</p>
                                    </div>
                                    <div class="col-9">
                                        <h5>Field type</h5>
                                        <select class="form-control change-field-type">
                                            @foreach($types as $key=>$value)
                                            <option value="{{$key}}">{{$value}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="line" data-option="instructions">
                                    <div class="col-3">
                                        <h5>Field instructions</h5>
                                        <p>HThe instructions guide for user easier know what they need to input.</p>
                                    </div>
                                    <div class="col-9">
                                        <h5>Field instructions</h5>
                                        <textarea class="form-control" rows="5"></textarea>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="options">
                                    <div class="line" data-option="defaultvaluetextarea">
                                        <div class="col-3">
                                            <h5>Default value</h5>
                                            <p>The default value of field when leave it blank</p>
                                        </div>
                                        <div class="col-9">
                                            <h5>Default value</h5>
                                            <textarea class="form-control" rows="5"></textarea>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="line" data-option="wysiwygtoolbar">
                                        <div class="col-3">
                                            <h5>Toolbar</h5>
                                            <p>The toolbar when use editor</p>
                                        </div>
                                        <div class="col-9">
                                            <h5>Toolbar</h5>
                                            <select class="form-control">
                                                <option value="basic">Basic</option>
                                                <option value="full">Full</option>
                                            </select>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>

                                    <div class="line" data-option="repeater">
                                        <div class="col-3">
                                            <h5>Repeater</h5>
                                        </div>
                                        <div class="col-9">
                                            <h5>Repeater</h5>
                                            <div class="add-new-field">
                                                <ul class="row list-group field-table-header clearfix">
                                                    <li class="col-4 list-group-item w-bold">Label</li>
                                                    <li class="col-4 list-group-item w-bold">Field name</li>
                                                    <li class="col-4 list-group-item w-bold">Field type</li>
                                                </ul>
                                                <div class="clearfix"></div>
                                                <ul
                                                    class="sortable-wrapper edit-field-group-items field-group-items ui-sortable">

                                                    <li class="ui-sortable-handle" data-position="1">
                                                        <div class="field-column">
                                                            <div class="row">
                                                                <div class="text col-4 field-label">Title</div>
                                                                <div class="text col-4 field-slug">tongquan_tag_title
                                                                </div>
                                                                <div class="text col-4 field-type">text</div>
                                                            </div>
                                                            <a class="show-item-details" title="" href="javascript:;"><i
                                                                    class="fa fa-angle-down"></i></a>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                        <div class="item-details repeater">
                                                            <div class="line" data-option="title">
                                                                <div class="col-3">
                                                                    <h5>Label</h5>
                                                                    <p>This is the title of field item. It will be shown
                                                                        on edit pages.</p>
                                                                </div>
                                                                <div class="col-9">
                                                                    <h5>Label</h5>
                                                                    <input type="text" class="form-control"
                                                                        placeholder="" value="New field">
                                                                </div>
                                                                <div class="clearfix"></div>
                                                            </div>
                                                            <div class="line" data-option="slug">
                                                                <div class="col-3">
                                                                    <h5>Field name</h5>
                                                                    <p>The alias of field item. Accepted numbers,
                                                                        characters and underscore.</p>
                                                                </div>
                                                                <div class="col-9">
                                                                    <h5>Field name</h5>
                                                                    <input type="text" class="form-control"
                                                                        placeholder="" value="">
                                                                </div>
                                                                <div class="clearfix"></div>
                                                            </div>
                                                            <div class="line" data-option="type">
                                                                <div class="col-3">
                                                                    <h5>Field type</h5>
                                                                    <p>Please select the type of this field.</p>
                                                                </div>
                                                                <div class="col-9">
                                                                    <h5>Field type</h5>
                                                                    <select class="form-control change-field-type">
                                                                        <optgroup label="Basic">
                                                                            <option value="text" selected="selected">
                                                                                Text field</option>
                                                                            <option value="textarea">Textarea</option>
                                                                            <option value="number">Number</option>
                                                                            <option value="email">Email</option>
                                                                            <option value="password">Password</option>
                                                                        </optgroup>
                                                                        <optgroup label="Content">
                                                                            <option value="wysiwyg">WYSIWYG editor
                                                                            </option>
                                                                            <option value="image">Image</option>
                                                                            <option value="file">File</option>
                                                                        </optgroup>
                                                                        <optgroup label="Choices">
                                                                            <option value="select">Select</option>
                                                                            <option value="checkbox">Checkbox</option>
                                                                            <option value="radio">Radio</option>
                                                                        </optgroup>
                                                                        <optgroup label="Other">
                                                                            <option value="repeater">Repeater</option>
                                                                        </optgroup>
                                                                    </select>
                                                                </div>
                                                                <div class="clearfix"></div>
                                                            </div>
                                                            <div class="line" data-option="instructions">
                                                                <div class="col-3">
                                                                    <h5>Field instructions</h5>
                                                                    <p>HThe instructions guide for user easier know what
                                                                        they need to input.</p>
                                                                </div>
                                                                <div class="col-9">
                                                                    <h5>Field instructions</h5>
                                                                    <textarea class="form-control" rows="5"></textarea>
                                                                </div>
                                                                <div class="clearfix"></div>
                                                            </div>
                                                            <div class="options">
                                                                <div class="line" data-option="defaultvalue">
                                                                    <div class="col-3">
                                                                        <h5>Default value</h5>
                                                                        <p>The default value of field when leave it
                                                                            blank</p>
                                                                    </div>
                                                                    <div class="col-9">
                                                                        <h5>Default value</h5>
                                                                        <input type="text" class="form-control"
                                                                            placeholder="" value="">
                                                                    </div>
                                                                    <div class="clearfix"></div>
                                                                </div>

                                                                <div class="line" data-option="placeholdertext">
                                                                    <div class="col-3">
                                                                        <h5>Placeholder</h5>
                                                                        <p>Placeholder text</p>
                                                                    </div>
                                                                    <div class="col-9">
                                                                        <h5>Placeholder</h5>
                                                                        <input type="text" class="form-control"
                                                                            placeholder="" value="">
                                                                    </div>
                                                                    <div class="clearfix"></div>
                                                                </div>
                                                            </div>

                                                            <div class="text-right p10">
                                                                <a class="btn red btn-remove" title="" href="#">Remove
                                                                    field</a>
                                                                <a class="btn blue btn-close-field" title=""
                                                                    href="#">Close field</a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="ui-sortable-handle" data-position="2">
                                                        <div class="field-column">
                                                            <div class="row">
                                                                <div class="text col-4 field-label">Content</div>
                                                                <div class="text col-4 field-slug">tongquan_tag_content
                                                                </div>
                                                                <div class="text col-4 field-type">textarea</div>
                                                            </div>
                                                            <a class="show-item-details" title="" href="#"><i
                                                                    class="fa fa-angle-down"></i></a>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                        <div class="item-details repeater">
                                                            <div class="line" data-option="title">
                                                                <div class="col-3">
                                                                    <h5>Label</h5>
                                                                    <p>This is the title of field item. It will be shown
                                                                        on edit pages.</p>
                                                                </div>
                                                                <div class="col-9">
                                                                    <h5>Label</h5>
                                                                    <input type="text" class="form-control"
                                                                        placeholder="" value="New field">
                                                                </div>
                                                                <div class="clearfix"></div>
                                                            </div>
                                                            <div class="line" data-option="slug">
                                                                <div class="col-3">
                                                                    <h5>Field name</h5>
                                                                    <p>The alias of field item. Accepted numbers,
                                                                        characters and underscore.</p>
                                                                </div>
                                                                <div class="col-9">
                                                                    <h5>Field name</h5>
                                                                    <input type="text" class="form-control"
                                                                        placeholder="" value="">
                                                                </div>
                                                                <div class="clearfix"></div>
                                                            </div>
                                                            <div class="line" data-option="type">
                                                                <div class="col-3">
                                                                    <h5>Field type</h5>
                                                                    <p>Please select the type of this field.</p>
                                                                </div>
                                                                <div class="col-9">
                                                                    <h5>Field type</h5>
                                                                    <select class="form-control change-field-type">
                                                                        <optgroup label="Basic">
                                                                            <option value="text" selected="selected">
                                                                                Text field</option>
                                                                            <option value="textarea">Textarea</option>
                                                                            <option value="number">Number</option>
                                                                            <option value="email">Email</option>
                                                                            <option value="password">Password</option>
                                                                        </optgroup>
                                                                        <optgroup label="Content">
                                                                            <option value="wysiwyg">WYSIWYG editor
                                                                            </option>
                                                                            <option value="image">Image</option>
                                                                            <option value="file">File</option>
                                                                        </optgroup>
                                                                        <optgroup label="Choices">
                                                                            <option value="select">Select</option>
                                                                            <option value="checkbox">Checkbox</option>
                                                                            <option value="radio">Radio</option>
                                                                        </optgroup>
                                                                        <optgroup label="Other">
                                                                            <option value="repeater">Repeater</option>
                                                                        </optgroup>
                                                                    </select>
                                                                </div>
                                                                <div class="clearfix"></div>
                                                            </div>
                                                            <div class="line" data-option="instructions">
                                                                <div class="col-3">
                                                                    <h5>Field instructions</h5>
                                                                    <p>HThe instructions guide for user easier know what
                                                                        they need to input.</p>
                                                                </div>
                                                                <div class="col-9">
                                                                    <h5>Field instructions</h5>
                                                                    <textarea class="form-control" rows="5"></textarea>
                                                                </div>
                                                                <div class="clearfix"></div>
                                                            </div>
                                                            <div class="options">
                                                                <div class="line" data-option="defaultvaluetextarea">
                                                                    <div class="col-3">
                                                                        <h5>Default value</h5>
                                                                        <p>The default value of field when leave it
                                                                            blank</p>
                                                                    </div>
                                                                    <div class="col-9">
                                                                        <h5>Default value</h5>
                                                                        <textarea class="form-control"
                                                                            rows="5"></textarea>
                                                                    </div>
                                                                    <div class="clearfix"></div>
                                                                </div>

                                                                <div class="line" data-option="placeholdertext">
                                                                    <div class="col-3">
                                                                        <h5>Placeholder</h5>
                                                                        <p>Placeholder text</p>
                                                                    </div>
                                                                    <div class="col-9">
                                                                        <h5>Placeholder</h5>
                                                                        <input type="text" class="form-control"
                                                                            placeholder="" value="">
                                                                    </div>
                                                                    <div class="clearfix"></div>
                                                                </div>

                                                                <div class="line" data-option="rows">
                                                                    <div class="col-3">
                                                                        <h5>Rows</h5>
                                                                        <p>Rows of this textarea</p>
                                                                    </div>
                                                                    <div class="col-9">
                                                                        <h5>Rows</h5>
                                                                        <input type="number" class="form-control"
                                                                            placeholder="Number" value="" min="1"
                                                                            max="10">
                                                                    </div>
                                                                    <div class="clearfix"></div>
                                                                </div>
                                                            </div>
                                                            <div class="text-right p10">
                                                                <a class="btn red btn-remove" title="" href="#">Remove
                                                                    field</a>
                                                                <a class="btn blue btn-close-field" title=""
                                                                    href="#">Close field</a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                                <div class="text-right pt10">
                                                    <a class="btn btn-info btn-add-field" href="#">Add field</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>

                                    <div class="line" data-option="buttonlabel">
                                        <div class="col-3">
                                            <h5>Button for repeater</h5>
                                        </div>
                                        <div class="col-9">
                                            <h5>Button for repeater</h5>
                                            <input type="text" class="form-control" placeholder="Add new" value="">
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                                <div class="text-right p10">
                                    <a class="btn red btn-remove" title="" href="#">Remove field</a>
                                    <a class="btn blue btn-close-field" title="" href="#">Close field</a>
                                </div>
                            </div>
                        </li>
                        @endif
                        <li class="ui-sortable-handle" id="custome-new-field" style="display:none;">
                            <div class="field-column">
                                <div class="row">
                                    <div class="text col-4 field-label">New field</div>
                                    <div class="text col-4 field-slug">new_field</div>
                                    <div class="text col-4 field-type">Text field</div>
                                </div>
                                <a class="show-item-details" title="" href="javascript:;"><i
                                        class="fa fa-angle-down"></i></a>
                                <div class="clearfix"></div>
                            </div>
                            <div class="item-details">
                                <div class="line" data-option="title">
                                    <div class="col-3">
                                        <h5>Label</h5>
                                        <p>This is the title of field item. It will be shown on edit pages.</p>
                                    </div>
                                    <div class="col-9">
                                        <h5>Label</h5>
                                        <input type="text" class="form-control is-valid" placeholder=""
                                            value="New field" aria-invalid="false">
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="line" data-option="slug">
                                    <div class="col-3">
                                        <h5>Field name</h5>
                                        <p>The alias of field item. Accepted numbers, characters and underscore.</p>
                                    </div>
                                    <div class="col-9">
                                        <h5>Field name</h5>
                                        <input type="text" class="form-control" placeholder="" value="">
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="line" data-option="type">
                                    <div class="col-3">
                                        <h5>Field type</h5>
                                        <p>Please select the type of this field.</p>
                                    </div>
                                    <div class="col-9">
                                        <h5>Field type</h5>
                                        <select class="form-control change-field-type">
                                            @foreach($types as $key=>$value)
                                            <option value="{{$key}}">{{$value}}</option>
                                            @endforeach
                                            {{-- <optgroup label="Basic">
                                                <option value="text" selected="selected">Text field</option>
                                                <option value="textarea">Textarea</option>
                                                <option value="number">Number</option>
                                                <option value="email">Email</option>
                                                <option value="password">Password</option>
                                            </optgroup>
                                            <optgroup label="Content">
                                                <option value="wysiwyg">WYSIWYG editor</option>
                                                <option value="image">Image</option>
                                                <option value="file">File</option>
                                            </optgroup>
                                            <optgroup label="Choices">
                                                <option value="select">Select</option>
                                                <option value="checkbox">Checkbox</option>
                                                <option value="radio">Radio</option>
                                            </optgroup>
                                            <optgroup label="Other">
                                                <option value="repeater">Repeater</option>
                                            </optgroup> --}}
                                        </select>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="line" data-option="mask">
                                    <div class="col-3">
                                        <h5>Field mask</h5>
                                        <p>Please select the type of this field.</p>
                                    </div>
                                    <div class="col-9">
                                        <h5>Field mask</h5>
                                        <select class="form-control change-field-mask">

                                        </select>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="line" data-option="instructions">
                                    <div class="col-3">
                                        <h5>Field instructions</h5>
                                        <p>HThe instructions guide for user easier know what they need to input.</p>
                                    </div>
                                    <div class="col-9">
                                        <h5>Field instructions</h5>
                                        <textarea class="form-control" rows="5"></textarea>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="options">
                                    <div class="line" data-option="defaultvalue">
                                        <div class="col-3">
                                            <h5>Default value</h5>
                                            <p>The default value of field when leave it blank</p>
                                        </div>
                                        <div class="col-9">
                                            <h5>Default value</h5>
                                            <input type="text" class="form-control" placeholder="" value="">
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="line" data-option="placeholdertext">
                                        <div class="col-3">
                                            <h5>Placeholder</h5>
                                            <p>Placeholder text</p>
                                        </div>
                                        <div class="col-9">
                                            <h5>Placeholder</h5>
                                            <input type="text" class="form-control" placeholder="" value="">
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                                <div class="text-right p10">
                                    <a class="btn red btn-remove" title="" href="javascript:;">Remove field</a>
                                    <a class="btn blue btn-close-field" title="" href="javascript:;">Close field</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <div class="text-right pt10">
                        <a class="btn btn-info btn-add-field" href="javascript:;">Add field</a>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<link rel="stylesheet" type="text/css"
    href="{{ env_host }}public/dashboard/botble/plugins/custom-field/css/custom-field.css" />
<link rel="stylesheet" type="text/css"
    href="{{ env_host }}public/dashboard/botble/plugins/custom-field/css/edit-field-group.css" />
<script src="{{ env_host }}public/dashboard/botble/plugins/custom-field/js/edit-field-group.js"></script>
<style type="text/css">
    .field-table-header {
        margin-left: 0px !important;
        margin-right: 0px !important;
    }

    .list-group-item+.list-group-item {
        border-top-width: 1px !important;
    }

</style>
<script>
    let totalAdded = 0;
    $(document).on('click', '.btn-add-field', function() {
        let html = $('#custome-new-field').html();
        let totalAdded = $('#custom_field_group_items>li').length;
        //$('#custom_field_group_items').append(`<li class="ui-sortable-handle" data-position="` + totalAdded + `">` + html + `</li>`)
        $(this).parent().parent().find('.field-group-items').append(`<li class="ui-sortable-handle" data-position="` + totalAdded + `">` + html + `</li>`);
    });

    $(document).on('click', '.show-item-details', function() {
        //let tag = $(this).parents(".ui-sortable-handle");
        let tag = $(this).parent().parent()
        if (tag.hasClass("active")) {
            tag.removeClass("active");
        } else {
            tag.addClass("active");
        }

    });

    $(document).on('change', '.item-details input, .item-details select, .item-details textarea', function() {
        var custom_fields = [];
        $('#custom_field_group_items > li > .item-details').each(function() {
            //let custom_fields_detail = [];
            let liId = $(this).parents("li").attr('id');
            if (liId != "custome-new-field" && !$(this).hasClass("repeater")) {
                let id = $(this).data("id");
                let title = $(this).find(".line[data-option='title']").find("input").val();
                let slug = $(this).find(".line[data-option='slug']").find("input").val();
                let instructions = $(this).find(".line[data-option='instructions']").find("textarea").val();
                let type = $(this).find(".line[data-option='type']").find("select").val();
                let mask = $(this).find(".line[data-option='mask']").find("select").val();
                var options = [];
                let defaultValue = $(this).find(".line[data-option='defaultValue']").find("input").val();
                let defaultValueTextarea = $(this).find(".line[data-option='defaultValueTextarea']").find("input").val();
                let placeholderText = $(this).find(".line[data-option='titplaceholderTextle']").find("input").val();
                let wysiwygToolbar = $(this).find(".line[data-option='wysiwygToolbar']").find("input").val();
                let selectChoices = $(this).find(".line[data-option='selectChoices']").find("input").val();
                let buttonLabel = $(this).find(".line[data-option='buttonLabel']").find("input").val();
                var options_detail = {
                    defaultValue: defaultValue,
                    defaultValueTextarea: defaultValueTextarea,
                    placeholderText: placeholderText,
                    wysiwygToolbar: wysiwygToolbar,
                    selectChoices: selectChoices,
                    buttonLabel: buttonLabel,
                    //rows: []
                };
                options.push(options_detail);
                let tag_repeater = $(this).find(".line[data-option='repeater']");
                let items = getJsonGroupItem(tag_repeater);
                console.log(items);
                var custom_fields_obj = {
                    id:id,
                     title:title,
                     slug:slug,
                     instructions:instructions,
                     type:type,
                     mask:mask,
                     options:options,
                     items:items,
                }
                custom_fields.push(custom_fields_obj);
            }
        });
        $("#custom_fields").val(JSON.stringify(custom_fields));
    });
    function getJsonGroupItem(tag){
        var custom_fields = [];
        $(tag).find('.item-details').each(function() {
            //let custom_fields_detail = [];
            let liId = $(this).parents("li").attr('id');
            if (liId != "custome-new-field") {
                let id = $(this).data("id");
                let title = $(this).find(".line[data-option='title']").find("input").val();
                let slug = $(this).find(".line[data-option='slug']").find("input").val();
                let instructions = $(this).find(".line[data-option='instructions']").find("textarea").val();
                let type = $(this).find(".line[data-option='type']").find("select").val();
                let mask = $(this).find(".line[data-option='mask']").find("select").val();
                var options = [];
                let defaultValue = $(this).find(".line[data-option='defaultValue']").find("input").val();
                let defaultValueTextarea = $(this).find(".line[data-option='defaultValueTextarea']").find("input").val();
                let placeholderText = $(this).find(".line[data-option='titplaceholderTextle']").find("input").val();
                let wysiwygToolbar = $(this).find(".line[data-option='wysiwygToolbar']").find("input").val();
                let selectChoices = $(this).find(".line[data-option='selectChoices']").find("input").val();
                let buttonLabel = $(this).find(".line[data-option='buttonLabel']").find("input").val();
                var options_detail = {
                    defaultValue: defaultValue,
                    defaultValueTextarea: defaultValueTextarea,
                    placeholderText: placeholderText,
                    wysiwygToolbar: wysiwygToolbar,
                    selectChoices: selectChoices,
                    buttonLabel: buttonLabel,
                   // rows: []
                };
                options.push(options_detail);

                 var custom_fields_obj = {
                    id:id,
                     title:title,
                     slug:slug,
                     instructions:instructions,
                     type:type,
                     mask:mask,
                     options:options,
                    // items:items,
                 }
                 custom_fields.push(custom_fields_obj);
            }
        });
        return custom_fields;
    }
    $(document).on("change",".line[data-option='type']",function(){
        let type  = $(this).find('select').val();
        let tag = $(this).parents("li");
        let mask = tag.find(".line[data-option='mask']").find("select");

            var form_data = new FormData();
            form_data.append("type", type);
            form_data.append("_token", '{{ csrf_token() }}');

            $.ajax({
                url: "http://dyndns.net/api/getMask",
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'POST',
                success: function (data) {
                    if(data.code=="200"){
                        mask.html("");
                        $.each(data.data,function(index,value){
                            mask.append(`<option vallue='${index}'>${value}</option>`)
                        });
                    }
                }
            });

    });
    $(document).on("click",".btn-remove",function(){
        let tag = $(this).parents("li");
        let id = $(this).parents(".item-details").data('id');
        $("#deleted_items").val($("#deleted_items").val()+" "+id);
        $(this).parents("li").remove();
    })
</script>
