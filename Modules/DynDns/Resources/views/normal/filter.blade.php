<div class="page-content-wrapper animated fadeInRight">
   <div class="page-content">
      <div class="row wrapper border-bottom page-heading">
         <div class="col-lg-12">
            <h2>{{ @$conf->cp_vn }}</h2>
            <ol class="breadcrumb">
               <li>
                  <a href="{{h::site_url()}}">Home</a>
               </li>
               <li>

                  <a href="{{h::site_url(h::area_admin.'/'.request()->segment(2))}}">{{$title}}</a>
               </li>
               <li class="active">
                  <strong style="text-transform:uppercase">{{request()->segment(3)}}</strong>
               </li>
            </ol>
         </div>
         <div class="col-lg-12"></div>
      </div>

      <div class="wrapper-content ">
          <form  name="form_admin" action="{{url(request()->segment(1).'/'.request()->segment(2).'/save_function')}}" method="post" enctype="multipart/form-data">
              <div class="row">
                  <div class="form-group">
                      <table style="width:100%">
                          <tr>
                              <th>
                                  <label class="desc">Entity</label>
                              </th>
                              <th>
                                  <label class="desc">Sắp xếp </label>
                              </th>
                          </tr>
                          <tr>
                              <td style="padding-right:10px;">

                                  <div class="input-group ">
                                      <span class="input-group-addon">
                                          <i class="fa fa-table" aria-hidden="true"></i>
                                      </span>
                                      <input type="text" class="form-control" name="table" value="<?=@$func->table?>" id="categoriesSearch" />
                                  </div>
                              </td>
                              <td>
                                  <div class="input-group ">
                                      <span class="input-group-addon">
                                          <i class="icon fa fa-sort" aria-hidden="true"></i>
                                      </span>
                                      <input data-for="#post_vn_alias" name="order" value="<?=@$func->order?>" class="form-control" type="text" />
                                  </div>


                              </td>
                          </tr>
                      </table>
                  </div>

                  <div class="form-group">
                      <table style="width:100%">
                          <tr>
                              <th>
                                  <label class="desc">Filter</label>
                              </th>
                          </tr>
                          <tr style="display:none">
                              <td  style="width:30px;">                                    
                                <button class="btn btn-danger" type="button"><i class="icon fa fa-plus" aria-hidden="true"></i></button>                                        
                              </td>
                              <td>
                                  <div class="input-group ">
                                      <span class="input-group-addon">
                                          <i class="icon fa fa-filter" aria-hidden="true"></i>
                                      </span>
                                      <select class="form-control">
                                          <option>And</option>
                                          <option>Or</option>
                                      </select>
                                  </div>
                              </td>
                              <td style="width:150px;">
                                  <div class="input-group ">
               
                                      <select class="form-control" >
                                          @foreach($fields as $f)
                                          <option>{{$f->name}}</option>
                                          @endforeach
                                      </select>
                                  </div>  
                              </td>
                              <td style="width:70px;">
                                  <select class="form-control">
                                    
                                      <option>like</option>
                                      <option>% like %</option>
                                      <option>% like</option>
                                      <option>like %</option>
                                      <option>=</option>
                                  </select>
                              </td>
                              <td>
                                  <input data-for="#post_vn_alias" name="field_list]" value="<?=@$func->field_list?>" class="form-control" type="text" />
                              </td>
                          </tr>
                          <tr>
                              <td colspan="5">
                                  <textarea class="form-control" >{{@$func->where}}</textarea>
                              </td>
                          </tr>
                          <tr>
                              <td colspan="5">
                                  <button>Filter</button>
                              </td>
                          </tr>
                      </table>
                  </div>
                  <div class="form-group">
                      <table style="width:100%">
                          <tr>
                              <th>
                                  <label class="desc">Select</label>
                              </th>
                          </tr>
                          <tr>
                              <td>
                                  <div class="input-group ">
                                      <span class="input-group-addon">
                                          <i class="icon fa fa-list" aria-hidden="true"></i>
                                      </span>
                                      <input data-for="#post_vn_alias" name="query_select]" value="<?=@$func->query_select?>" class="form-control" type="text" />
                                  </div>
                              </td>
                          </tr>
                      </table>
                  </div>
              </div>
             {{h::token()}}

              <br/>
              <button type="submit" class="btn blue">
                  <i class="fa fa-paste"></i>Save
              </button>
          </form>

          <div class="row">            
            <div class="hidden-xs">
             
            </div>  
         </div>
      </div>
      {!! View(h::area_admin.'::layout.footer') !!}
   </div>
</div>

@extends(h::area_admin.'::layout.icon')
@extends(h::area_admin.'::sys.template.script')