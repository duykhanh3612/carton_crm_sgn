class Tasks {
  constructor(params = {}) {
    this.root = $("#sortable");

    $.extend(this, params);

    if (this.auid) {
      var temp = $("#RelatedTo").val() ?? [];
      this.assignees = [...temp, $("#AssignedTo").val()];

      this.ChannelManager = $("#ChannelManager").val();
      this.currentname = "";
    }
  }
}
Tasks.prototype.removeDataName = function () {
  $("#sortable .panel").each(function () {
    var close = $(this).find(".tasks-details-close").is(":checked");
    if (close) {
      var input = $(this).find(":input");
      input;
      input.removeAttr("data-name");
    }
  });
};
Tasks.prototype.addEventListenner = function () {
  var _this = this;
  this.createSelect2();
  this.disablePanel();
  this.blockAssigned();
  this.blockAddTask();
  this.getStateAddSelectTask();
  this.createAttachmentHead();
  this.countAllDuration();
  // this.onChange_staff();
  this.addDatePicker();
  this.createDragTasks();
  this.createDocumentAttachmentList();
  this.hideRelateToAssignerTo();
  this.addColorAllStatusPanel();
  this.setColorStatus("#Status");
  this.removeDataName();
  this.changeOptionsStaffs();


  $("form").attr("autocomplete", "off");
  $(".mynamestatus").change();
  $("textarea").css("overflow", "hidden").autogrow();
  setTimeout(()=>{ $("#Type").chosen("destroy"); },100);


  this.root
    .on("click", ".edit-task", function () {
      _this.clickEditTask(this);
    })
    .on("click", ".save-task", function () {
      $("#submitBtn").trigger("click");
    })
    .on("change", "[data-name=CloseTask]", function () {
      _this.toggleDisplayEditbtn(this);
    });

  $("body")
    .on("click", "#check-close", function () {
      _this.clickAllClose(this);
    })
    .on("click", ".attachments-wrap i.remove", function () {
      _this.removeFileAttachment(this);
    })
    .on("changeDate", "[data-name=fromDate]", function () {
      _this.validFromData(this);
    })
    .on("changeDate", "[data-name=toDate]", function () {
      _this.validToDate(this);
    })
    .on("change", "[data-name=Status],[data-name=type]", function () {
      _this.setColorStatusPanel(this);
    })
    .on("click", ".mybtn-attachment", function () {
      _this.setCurrentPanelTarget(this);
    })
    .on("change", ".my-PercentComplete", function () {
      _this.validPrecentInput(this);
    })
    .on("change", "#PercentComplete", function () {
      _this.validPrecentInput(this, true);
    })
    .on("change", ".tasks-duration", function () {
      _this.countAllDuration();
    })
    .on("change", "#RelatedTo,#AssignedTo", function () {
      // _this.onChange_staff();
    })
    .on("change", "#AssignTheApprover, #AssignedTo", function (el) {
      _this.checkUniqueAssignApprover(this);
    })
    .on("change", "#Department", function () {
      // _this.newListDepartment(this);
    })
    .on("click", ".task-color", function () {
      _this.changeColorTask(this);
    })
    .on("click", ".task-color-clear", function () {
      _this.cleanColorTask(this);
    })
    .on("click", "#btn-Tasks", function () {
      _this.addNewTask();
    })
    .on("change", ".my-reportdate", function () {
      _this.validReportdatePanel(this);
    })
    .on("click", ".btn-processed", function () {
      _this.submitPanel(this);
    })
    .on("click", ".remove-rows-tabs", function () {
      _this.removeRowTask(this);
    })
    .on(
      "click",
      ".block-is-checked.tasks-details-close.custom-checkbox",
      function () {
        _this.closeTask(this);
      }
    )
    .on("submit", "#updateFrm", function () {
      _this.refreshOrderNumber();
    })
    .on("change", ".mynamestatus", function () {
      _this.setColorStatus(this);
      _this.getStateAddSelectTask(this);
    })
    .on("click", "#submitBtn", function () {
      _this.checkNullselect();
    })
    .on("change", "[data-staff]", function () {
      _this.changeOptionsStaffs(this);
    })
    .on("click", "[data-btn=report]", function (e) {
      e.preventDefault();
      _this.openReport(this);
    })
    .on("click", "#ModalReport .btn-primary", function () {
      _this.saveReport(this);
    })
    .on("click", "[data-btn=report-full]", function () {
      console.log("report full");
      _this.loadReportFull(this);
    })
    .on("click", ".form-left [data-toggle]", function () {
      _this.hideFullReport(this);
    })
    .on("click", "#emailRemid", function () {
      _this.remidAllEmail();
    })
    .on("change","#Type",function(){
      _this.changeColorType(this);
    });
};
Tasks.prototype.changeColorType = function(el){

  var color = $("option:selected", el).data("color");
  if (!color) {
    $(el).attr("style", " ");
  } else {
    color = color.replace("background-color:#fff;", "");
    $(el).next().find(".chosen-single").css({
      color: "#fff",
      "background-color": color,
    });

  }

}
Tasks.prototype.hideFullReport = function (el) {
  var group = $(el).closest(".panel-default");
  $(el)
    .closest(".panel-default")
    .find(".form-right")
    .find("[data-toggle]")
    .eq(0)
    .trigger("click");
};
Tasks.prototype.loadReportFull = async function (el) {
  var did = $(el).closest(".panel-default").find(".group-button").data("did");
  var id = $(el)
    .closest(".panel-default")
    .find(".group-button")
    .data("assingee");
  var SortOrder = $(el)
    .closest(".panel-default")
    .find(".group-button")
    .data("sort");
  if (typeof id == "undefined" || typeof did == "undefined") {
    showNoti(
      "Thông báo không hợp lệ",
      "Không tìm thấy công việc báo cáo hoặc không tìm thấy người làm nhiệm vụ",
      "Err"
    );
    return;
  }
  var res = await this.send({ did, id, full_report: false }, "openReport", {
    html: true,
  });
  $(el)
    .closest(".panel-default")
    .find(".tab-pane.report-full #basic-example" + SortOrder)
    .html(res);
  // console.log(SortOrder);
  tinymce.init({
    selector: "textarea#basic-example" + SortOrder,
    plugins: "preview",
    menubar: "view",
    readonly: 1,
    toolbar: "preview",
  });
};
Tasks.prototype.getAssignees = function () {
  var assignee = $("#AssignedTo").val();
  var relate = $("#RelatedTo").select2("val");

  console.log({ relate });
  if (relate) {
    relate.push(assignee);
  } else {
    relate = [assignee];
  }
  console.log({ relate });
  return relate;
};
Tasks.prototype.getApprovers = function () {
  var approver = $("#AssignTheApprover").val();
  var channel = $("#ChannelManager").select2("val");
  if (channel) {
    channel.push(approver);
  } else {
    channel = [approver];
  }
  return channel;
};
Tasks.prototype.isMytask = function (el) {
  var assignee = $(el).closest(".group-button").data("assingee");
  return this.userID == assignee;
};
Tasks.prototype.checkCasePremission = function (isMytask) {
  var assignees = this.getAssignees();
  var approvers = this.getApprovers();
  var isAssignee = this.existsItemObject(assignees, this.userID);
  var isApprover = this.existsItemObject(approvers, this.userID);

  console.log({ isAssignee, isApprover });
  var result = "";
  if (isAssignee == true && isApprover == true && isMytask == true) {
    result = "assignee-approver-my";
  }
  if (isAssignee == true && isApprover == false && isMytask == true) {
    result = "assignee-my";
  }
  if (isAssignee == false && isApprover == true && isMytask == true) {
    result = "approver";
  }
  if (isAssignee == false && isApprover == false && isMytask == true) {
    result = "error";
  }

  if (isAssignee == true && isApprover == true && isMytask == false) {
    result = "approver";
  }
  if (isAssignee == true && isApprover == false && isMytask == false) {
    result = "error";
  }
  if (isAssignee == false && isApprover == true && isMytask == false) {
    result = "approver";
  }
  if (isAssignee == false && isApprover == false && isMytask == false) {
    result = "error";
  }


  console.log({ per: result, isAssignee, isApprover, isMytask });

  return result;
};
Tasks.prototype.existsItemObject = function (object, item) {
  var result = false;
  $.each(object, function (i, k) {
    if (k == item) {
      result = true;
      return;
    }
  });
  return result;
};
Tasks.prototype.send = function (data, url, option = {}) {
  // var domain = window.location.origin;
  // console.log({ domain });
  return new Promise((resolve, reject) => {
    $.ajax({
      url: `tasks/${url}`,
      type: "POST",
      data: data,
      beforeSend: function () {
        showProcess(1);
      },
      complete: function () {
        hideLoading();
      },
      success: function (res) {
        if (res != null) {
          if (option.html) {
            resolve(res);
          } else {
            res = JSON.parse(res);
            resolve(res.data);
          }
        } else {
          reject({});
        }
      },
      timeout: 20000,
      error: function (jqXHR, textStatus, errorThrown) {
        hideLoading();
        reject({});
      },
    });
  });
};
Tasks.prototype.openReport = async function (el) {
  var did = $(el).closest(".panel-default").find(".group-button").data("did");
  var id = $(el)
    .closest(".panel-default")
    .find(".group-button")
    .data("assingee");
  if (typeof id == "undefined" || typeof did == "undefined") {
    showNoti(
      "Thông báo không hợp lệ",
      "Không tìm thấy công việc báo cáo hoặc không tìm thấy người làm nhiệm vụ",
      "Err"
    );
    return;
  }
  var res = await this.send({ did, id }, "openReport", { html: true });
  $("#ModalReport").html(res).modal("show");
};
Tasks.prototype.saveReport = async function (el) {
  var text = tinyMCE.get("context_report").getContent();
  var did = $(el).data("did");
  var id = $(el).data("assingee");
  var res = await this.send({ did, id, text }, "saveReport");
  if (res.status) {
    showNoti("Save report success", "Success", "Ok");
  } else {
    showNoti("Save report fail", "Err", "Err");
  }
  $("#ModalReport").html("").modal("hide");
};
Tasks.prototype.changeOptionsStaffs = function () {
  var options = [];
  var unique = [];
  $("#mainTable-tasks")
    .find("[data-staff]")
    .each(function () {
      var id = $(this).val();
      if (Array.isArray(id)) {
        unique = unique.concat(id);
      } else {
        unique.push(id);
      }
    });
  unique = unique.filter((v, i, a) => a.indexOf(v) === i);
  // console.log(unique);
  unique.forEach(function (v) {
    var html = $("#mainTable-tasks")
      .find("[data-staff] option[value=" + v + "]")
      .html();
    options.push({ id: v, text: html });
  });

  $("#selectTasks").html("").select2({
    data: options,
    placeholder: "Search ...",
  });
};
Tasks.prototype.checkNullselect = function () {
  $("[data-required=1]").each(function () {
    var val = $(this).val();
    if (val == "") {
      $(this).closest("[class*=option-added]").find("button.edit-task").click();
      return;
    }
  });
};
Tasks.prototype.interfaceSelect2 = function (el, url, data = {}) {
  $(el).select2({
    placeholder: "Search for a repository",
    ajax: {
      delay: 250,
      url: "tasks/" + url,
      dataType: "json",
      data: function (params) {
        var queryParameters = {
          q: params.term,
        };

        return Object.assign(queryParameters, data);
      },
      processResults: function (data) {
        var options = [];
        $.each(data, function (k, v) {
          options.push({
            id: k,
            text: v,
          });
        });

        return {
          results: options,
        };
      },
    },
  });
};
Tasks.prototype.createSelect2 = function () {
  $(".select2").select2({
    placeholder: "Search for a repository",
  });

  // create select2 department
  this.interfaceSelect2(".select2#Department", "getDepartment");

  // create select2 assigned
  var department = $("#department").val();
  this.interfaceSelect2(".select2#AssignedTo", "getAssigned", {
    d: department,
  });

  // create select2 RelatedTo
  this.interfaceSelect2(".select2#RelatedTo", "getAssigned", { d: department });

  // create select2 Viewers
  this.interfaceSelect2(".select2#Viewers", "getAssigned", { d: department });

  // create select2 AssignTheApprover
  this.interfaceSelect2(".select2#AssignTheApprover", "getAssigned", {
    d: department,
  });

  // create select2 ChannelManager
  this.interfaceSelect2(".select2#ChannelManager", "getAssigned", {
    d: department,
  });

  // // create select2 selectTasks
  // this.interfaceSelect2(".select2#selectTasks","getAssigned",{ d: department });
};
Tasks.prototype.setColorStatus = function (el) {
  var color = $("option:selected", el).data("color");
  if (!color) {
    $(el).attr("style", " ");
  } else {
    color = color.replace("background-color:#fff;", "");
    $(el).css({
      color: "#fff",
      "background-color": color,
    });

  }
};
Tasks.prototype.createDragTasks = function () {
  var _this = this;
  var el = document.getElementById("sortable");
  Sortable.create(el, {
    swap: true, // Enable swap plugin
    handle: ".draggable-item",
    swapClass: "highlight", // The class applied to the hovered swap item
    animation: 150,
    ghostClass: "blue-background-class",
    onUpdate: function () {
      _this.updateNo();
    },
  });
};
Tasks.prototype.addDatePicker = function () {
  if ($(".bootstrap-datetimepicker").length) {
    $(".bootstrap-datetimepicker").datepicker({
      format: "yyyy-mm-dd",
      language: "vi",
      autoclose: true,
      todayHighlight: true,
    });
  }

  if ($("[data-date]").length) {
    $("[data-date]").datetimepicker({
      format: "YYYY-MM-DD HH:mm",
      useCurrent: false,
      ignoreReadonly: true,
      showClose: true,
      showClear: true,
      // daysOfWeekDisabled: daysDisabled,
      // defaultDate: tomorrow,
      tooltips: {
        close: "accept date",
      },
      icons: {
        time: "glyph-icon icon-clock-o",
        date: "glyph-icon icon-calendar",
        up: "glyph-icon icon-chevron-up",
        down: "glyph-icon icon-chevron-down",
        previous: "glyph-icon icon-chevron-left",
        next: "glyph-icon icon-chevron-right",
        clear: "fa fa-eraser",
        close: "fa fa-check",
      },
    });
  }
};
Tasks.prototype.refreshOrderNumber = function () {
  var stt = 1;
  $(".myorder").each(function () {
    $(this).val(stt);
    stt++;
  });
};
Tasks.prototype.closeTask = function (el) {
  if (this.isadmin == "1") {
    var panels = $(".itemList .panel-body");
    $.each(panels, function () {
      var _panel = $(this);
      $("#check-close").parent().removeClass("disabled");
      _panel.find(":input").removeClass("disabled");
      setTimeout(function () {
        $("#selectTasks").removeClass("disabled");
        _panel.find(".attachments").removeClass("disabled");
        _panel
          .find(".block-status-checkbox.block-checkbox")
          .removeClass("disabled");
      }, 300);
    });
  }

  var panel = $(el).closest(".panel-body");

  if ($(el).is(":checked")) {
    panel.find(":input").removeAttr("data-required").addClass("disabled");
    panel.find(".attachments").addClass("disabled");
  }
};

Tasks.prototype.create_atacttmet = function ($istt, isRight = false) {
  var _this = this;

  if (
    $(".tasks-file" + $istt).length &&
    !$(".tasks-file" + $istt).hasClass("has-file")
  ) {
    $(".tasks-file" + $istt).addClass("has-file");
    $(".tasks-file" + $istt).uploadFile({
      url: site_url + "ajax/ajax_attachment",
      fileName: "myfile",
      formData: {
        dir: _this.dir,
      },
      uploadButtonClass:
        "btn btn-border btn-alt btn-hover border-orange font-orange waves-effect pull-right mybtn-attachment",
      allowedTypes: "xls,xlsx,doc,docx,pdf,rar,zip,ppt,pptx,png,jpg,gif",
      uploadErrorStr: "File không đúng danh mục!",

      maxFileSize: 5240000,
      multiple: true,
      showErrType: 1,
      dragDropStr: "",
      onSuccess: function (files, data) {
        _this.showAttachment(files, data, isRight);
        $(".ajax-file-upload-statusbar").fadeOut();
      },
    });
  }
};

Tasks.prototype.removeRowTask = function (el) {
  var t = $(el).closest(".panel.panel-default");
  var _this = this;
  $.alerts.confirm(
    "Will you delete this task?<br/>",
    "Confirm delete",
    function (r) {
      if (r == true) {
        t.remove();
        $.ajax({
          url: site_url + "tasks/ajax_delete_tasks",
          method: "post",
          data: { id: t.find(".myid").val() },
          success: function (data) {
            _this.updateNo();
            if (data) showNoti("Xóa thành công!", "Tasks", "Ok");
          },
          error: function (e) {
            showNoti("Xóa thất bại!", "Tasks", "Err");
          },
        });
      }
    }
  );
};
Tasks.prototype.validSubmit = function (el) {
  var isNull = false;
  var elements = ["PercentComplete", "ActualDuration", "ExpectedResult"];
  var group = $(el).closest(".form-right");
  elements.forEach(function (v) {
    var element = group.find("[data-name=" + v + "]");
    var value = element.val();
    if (!value || value == "") {
      isNull = true;
      console.log({ v, value });
      element.closest("div").find("errordiv").show();
      return true;
    }
  });
  return isNull;
};
Tasks.prototype.submitPanel = function (el) {
  var submit_btn = $(el);
  var panel = submit_btn.closest(".panel-body");
  var _this = this;
  // var closeBtn = $(el).closest(".panel-body").find("[data-name=CloseTask]")
  var real_time = panel.find(".my-auto");
  var isNull = this.validSubmit(el);

  if (isNull) return false;

  $.alerts.confirm(
    "Will you confirm this action?<br/><i>You can't take action after this operation</i>",
    "Confirm processed",
    function (r) {
      if (r) {
        var file = [];
        var obj = {};
        panel.find(":input").each(function () {
          var name = $(this).data("name");
          var val = $(this).val();
          if (!!name) obj[name] = val;
          console.log({ name, val, obj });
        });
        var file_target = [];
        var file_actual = [];
        panel.find(".wrapper-file.input-target :input").each(function () {
          file_target.push($(this).val());
        });
        panel.find(".wrapper-file.input-actual :input").each(function () {
          file_actual.push($(this).val());
        });
        obj["parent"] = $("#id").val();
        obj["Attachments"] = JSON.stringify(file_target);
        obj["AttachmentsResult"] = JSON.stringify(file_actual);

        obj["flag"] = obj["flag"] ? obj["flag"] : 1;

        console.log(obj);
        //todo ajax to ajax_task_detail
        var $all_close =
          obj.Comments != "" ||
          obj.ExpectedResult != "" ||
          obj.PercentComplete == 100 ||
          obj.Attachments != "[]" ||
          obj.AttachmentsResult != "[]";
        if (!!$all_close && $all_close == true) {
          obj.Status = 4;
        }
        $.ajax({
          url: site_url + "tasks/ajax_task_details",
          method: "post",
          data: obj,
          success: function (data) {
            panel.find(":input").addClass("disabled");
            panel.find("button").addClass("disabled");
            panel.find("select").addClass("disabled");
            panel.find(":checkbox").addClass("disabled");
            panel.find(".custom-checkbox").prop("checked", true);
            submit_btn.addClass("disabled");
            var newDate = "1 sec'" + " before";
            real_time.val(newDate);
            // closeBtn.click();
            _this.closeTask();
          },
          error: function (e) {
            console.log(e);
          },
        });
      }
    }
  );
};
Tasks.prototype.validReportdatePanel = function (el) {
  var date = $(el).val();
  var pal = $(el).closest(".panel");
  var stt = pal.find(".myorder").val();
  var enddate = $("toDate" + stt).val();
  if (date > enddate) {
    $(el).val(" ");
    showNoti("The date is validate!", "Err", "Ok");
  }
};
Tasks.prototype.remidAllEmail = async function () {
  var id = $("#id").val();
  var res = await this.send({ id }, "sendEmailRemid", { html: true });
  console.log({ res });
  if (res == "Success") {
    showNoti("Emails sent successfully!", "Success", "Ok");
  } else {
    showNoti("Error Sending Email!", "Failed", "Err");
  }
};
Tasks.prototype.addNewTask = function () {
  //todo click add tasks

  var name = $("#selectTasks option:selected").text();
  var id = $("#selectTasks option:selected").val();
  var index = this.root.find(".panel.panel-default").length;
  if (!!id && id !== "") {
    var _this = this;
    $.ajax({
      url: site_url + "tasks/ajax_add_tasks",
      method: "POST",
      data: {
        stt: index,
        name: name,
        add_new: true,
        isadmin: true,
        auid: _this.auid,
        userID: _this.userID,
        assignee: id,
      },
      success: function (data) {
        if (data) {
          var text = $.parseJSON(data);
          $(".itemList").prepend(text.html);
          var add_new = $(".add_new:last");
          _this.reload_addNew();
          _this.create_name_input(add_new);
          _this.create_atacttmet(text.stt);
          _this.create_atacttmet("-" + text.stt, true);
          _this.createSelect2();
          $(".procces-submit a").last().addClass("disabled");
        }
      },
    });
  }

  // var last_task = $("#sortable .panel.panel-default").last();
  // this.scrollTopSmooth(last_task);
};

Tasks.prototype.scrollTopSmooth = function (el) {
  // off/on for test

  var top = 0;
  try {
    $(el).focus();
    var pos = $(el).offset();
    var tag = $(el).attr("tagName");
    if (tag == "INPUT") $(el).focus();
    top = pos.top - 150;
  } catch (error) {}

  $("html, body").animate({ scrollTop: top }, 1500);
};
Tasks.prototype.cleanColorTask = function () {
  $(".task-color").each(function () {
    $(this).removeClass("active");
  });
  if (this.oldColor) {
    $(".task-color." + this.oldColor).addClass("active");
    $("#Color").val(this.oldColor);
  } else {
    $("#Color").val("");
  }
};
Tasks.prototype.changeColorTask = function (el) {
  $(".task-color").each(function () {
    $(this).removeClass("active");
  });
  $(el).addClass("active");
  $("#Color").val($(el).data("color"));
};
Tasks.prototype.newListDepartment = function (el) {
  var id = $(el).val();
  if (id != "" && id != "General") {
    $.ajax({
      url: site_url + "tasks/ajax_staff",
      method: "POST",
      data: { id: id },
      success: function (data) {
        if (data) {
          $("#RelatedTo").html(data).trigger("chosen:updated");
          $("#AssignedTo").html(data).trigger("chosen:updated");
        }
      },
    });
  } else {
    var data = '<option value="">Select...</option>';
    $.each($staff, function (i, $k) {
      if (!!i) {
        data += '<option value="' + i + '">' + $k + "</option>";
      }
    });
    $("#RelatedTo").html(data).trigger("chosen:updated");
    $("#AssignedTo").html(data).trigger("chosen:updated");
  }
};
Tasks.prototype.checkUniqueAssignApprover = function (el) {
  var id = $(el).attr("id");
  var Carrier = $("#AssignTheApprover").val();
  var Approver = $("#AssignedTo").val();
  var compare_value = id == "AssignTheApprover" ? Approver : Carrier;
  if (Carrier != "" && Approver != "" && $(el).val() == compare_value) {
    showNoti(
      "Assign the approver & Assigned To cannot be the same",
      "Warning",
      "War"
    );
    $(el).val("").trigger("chosen:updated");
    return false;
  }
};
Tasks.prototype.hideRelateToAssignerTo = function () {
  if (this.currentApprover == $("#RelatedTo").val()) {
    $("#RelatedTo").val(" ");
  }
  if (this.currentApprover == $("#AssignedTo").val()) {
    $("#AssignedTo").val(" ");
  }
};
Tasks.prototype.onChange_staff = function () {
  var RelatedTo = $("#RelatedTo").val();
  var AssignedTo = parseInt($("#AssignedTo").val());
  var arrStaff = [];
  var listSatff = {};
  if ($.isArray(RelatedTo)) {
    $.each(RelatedTo, function (i, k) {
      arrStaff[i] = parseInt(k);
    });
  } else {
    if (!!AssignedTo) {
      arrStaff.push(AssignedTo);
    }
  }
  $.each(arrStaff, function (k, item) {
    if (!!item) {
      if (!!$staff[item] && $staff[item] != "") {
        listSatff[item] = $staff[item];
      }
    }
  });
  if (!!AssignedTo)
    listSatff[AssignedTo] = $("#AssignedTo option:selected").text();
  $list = '<option value="">Select...</option>';
  if (Object.keys(listSatff).length > 0) {
    $.each(listSatff, function (keys, items) {
      if (!!keys) {
        $list +=
          '<option class="option-added' +
          keys +
          '" value="' +
          keys +
          '">' +
          items +
          "</option>";
      }
    });
  }
  $("#selectTasks").html($list);
  $("#selectTasks").trigger("chosen:updated");
};
Tasks.prototype.countAllDuration = function () {
  var all_duration = 0;
  $(".tasks-duration").each(function () {
    all_duration += parseInt($(this).val()) || 0;
  });
  $("#all-duration").val(all_duration);
};
Tasks.prototype.validPrecentInput = function (el, isHead = false) {
  if ($(el).val() < 0 || $(el).val() > 100) {
    $(el).val(0);
    if (isHead) {
      showErrOfField("PercentComplete", "PercentComplete");
    } else {
      showNoti("Percent Complete không hợp lệ!", "Cảnh báo", "War");
    }
  }
};
Tasks.prototype.createDocumentAttachmentList = function () {
  var _this = this;
  this.root.find(".panel.panel-default").each(function () {
    _this.createDocumentAttachment(this);
  });
};
Tasks.prototype.createDocumentAttachment = function (el) {
  var _this = this;
  var stt = $(el).find(".myorder").val();
  var attachment_list = [
    {
      isRight: true,
      selector: ".tasks-file-" + stt,
    },
    {
      isRight: false,
      selector: ".tasks-file" + stt,
    },
  ];

  attachment_list.forEach(function (obj) {
    $(obj.selector).uploadFile({
      url: site_url + "ajax/ajax_attachment",
      fileName: "myfile",
      formData: {
        dir: _this.dir,
      },
      uploadButtonClass:
        "btn btn-border btn-alt btn-hover border-orange font-orange waves-effect pull-right mybtn-attachment",
      allowedTypes: "xls,xlsx,doc,docx,pdf,rar,zip,ppt,pptx,png,jpg,gif",
      uploadErrorStr: "File không đúng danh mục!",
      maxFileSize: 5240000,
      multiple: true,
      showErrType: 1,
      dragDropStr: "",
      onSuccess: function (files, data) {
        _this.showAttachment(files, data, obj.isRight);

        $(".ajax-file-upload-statusbar").fadeOut();
      },
    });
  });
};
Tasks.prototype.setCurrentPanelTarget = function (el) {
  this.currentstt = $(el).parent().parent().data("stt");
  this.currentname = $(el).parent().parent().data("name");
};
Tasks.prototype.setColorStatusPanel = function (el) {
  var color = $(el).find("option:checked").data("color");
  $(el).css({ background: color, color: "#fff" });
};
Tasks.prototype.addColorAllStatusPanel = function () {
  var _this = this;
  this.root.find(".panel.panel-default .mynamestatus").each(function () {
    _this.setColorStatusPanel(this);
  });
};
Tasks.prototype.validToDate = function (el) {
  var duedateFrom = $(el).closest(".row").find("[data-name=fromDate]");
  if (duedateFrom.val() != "" && $(el).val() < duedateFrom.val()) {
    showNoti("Ngày không hợp lệ", "Cảnh báo:", "War");
    $(el).val(null);
    return;
  }
  var maxDate = $("#DueDateTo").val();
  if (maxDate == "") {
    showNoti("Vui lòng xác nhận ngày kết thúc Tasks", "Cảnh báo:", "War");
    $(el).val(null);
    $("#DueDateTo").focus();
    return;
  }
  if (maxDate != "" && $(el).val() > maxDate) {
    showNoti(
      "Ngày kết thúc đã vượt quá thời hạn <br/>Due Date: " + maxDate,
      "Cảnh báo:",
      "War"
    );
    $(el).val(null);
  }
};
Tasks.prototype.validFromData = function (el) {
  var duedateTo = $(el).closest(".row").find("[data-name=toDate]");
  var maxDate = $("#DueDateTo").val();
  if (duedateTo.val() != "" && $(el).val() > duedateTo.val()) {
    showNoti("Ngày không hợp lệ", "Cảnh báo:", "War");
    $(el).val(null);
  }
  if (maxDate != "" && $(el).val() > maxDate) {
    showNoti(
      "Ngày kết thúc đã vượt quá thời hạn <br/>Due Date: " + maxDate,
      "Cảnh báo:",
      "War"
    );
    $(el).val(null);
  }
};
Tasks.prototype.createAttachmentHead = function () {
  var _this = this;
  $("#attachmentUploader").each(function () {
    var attachment_container = $(this)
      .closest(".col-sm-9")
      .find(".wrapper-file");
    $(this).uploadFile({
      url: site_url + "ajax/ajax_attachment",
      fileName: "myfile",
      formData: {
        dir: _this.dir,
        // 'code': code
      },
      uploadButtonClass:
        "btn btn-border btn-alt btn-hover border-orange font-orange waves-effect pull-right mybtn-attachment",
      allowedTypes: "xls,xlsx,doc,docx,pdf,rar,zip,ppt,pptx,png,jpg,gif",
      uploadErrorStr: "File không đúng danh mục!",
      maxFileSize: 5240000,
      multiple: true,
      showErrType: 1,
      dragDropStr: "",
      onSuccess: function (files, data) {
        _this.showAttachmentHeader(files, data, attachment_container);

        $(".ajax-file-upload-statusbar").fadeOut();
      },
    });
  });
};
Tasks.prototype.showAttachment = function (src, dst, isRight = false) {
  var stt = this.currentstt;
  var html =
    '<div><div class="attachments-wrap"><i class="fa fa-close remove"></i><input data-file="' +
    src +
    '" value="' +
    dst.split("/").pop() +
    '" type="hidden" name="task[' +
    stt +
    '][Attachments][]" /><div class="image-small"><div class="no-image" title="' +
    dst.split("/").pop() +
    '"><img src="assets/img/file_ext/' +
    dst.split("/").pop().split(".").pop() +
    '.png" /></div></div></div></div>';
  if (isRight) {
    var html =
      '<div><div class="attachments-wrap"><i class="fa fa-close remove"></i><input data-file="' +
      src +
      '" value="' +
      dst.split("/").pop() +
      '" type="hidden" name="task[' +
      stt +
      '][AttachmentsResult][]" /><div class="image-small"><div class="no-image" title="' +
      dst.split("/").pop() +
      '"><img src="assets/img/file_ext/' +
      dst.split("/").pop().split(".").pop() +
      '.png" /></div></div></div></div>';
    $("#Attachments-list-" + stt).append(html);
  } else {
    $("#Attachments-list" + stt).append(html);
  }
};
Tasks.prototype.showAttachmentHeader = function (src, dst, container) {
  var html = "<div>";
  html +=
    '<div class="attachments-wrap"><i class="fa fa-close remove"></i><input data-file="' +
    src +
    '" value="' +
    dst.split("/").pop() +
    '" type="hidden" name="Attachments[]" /><div class="image-small"><div class="no-image" title="' +
    dst.split("/").pop() +
    '"><img src="assets/img/file_ext/' +
    dst.split("/").pop().split(".").pop() +
    '.png" /></div></div></div>';
  html += "</div>";
  container.append(html);
};
Tasks.prototype.blockAssigned = function () {
  if (this.userLevel != 1 && this.userLevel != 2) {
    if ($("#id").val()) $("#AssignedTo").addClass("disabled");
  }
};
Tasks.prototype.disablePanel = function () {
  // if (this.isadmin != "1") {
  //     var panels = $('.itemList .panel-body');
  //     $.each(panels, function () {
  //         var panel = $(this);
  //         if (this.closeall == 1 && panel.find(".myuid_user").val() != this.myuid && this.myuid != this.auid) {
  //             $("#check-close").removeAttr("name");
  //             $("#check-close").parent().addClass('disabled');
  //             panel.find(':input').addClass('disabled');
  //             panel.find(':input').removeAttr('data-name');
  //             panel.find('.remove-rows-tabs').remove();
  //             panel.find('.draggable-item').remove();
  //             setTimeout(function () {
  //                 panel.find(':button').addClass('disabled');
  //                 panel.find('.procces-submit').addClass('disabled');
  //                 panel.find('label').addClass('disabled');
  //                 $('#selectTasks').addClass('disabled');
  //                 $('#btn-Tasks').addClass('disabled');
  //             }, 500);
  //         }
  //     })
  // }
};
Tasks.prototype.getStateAddSelectTask = function (el = null) {
  var isCheck = $("[name=CloseTask]").is(":checked");
  if (isCheck) {
    $("#btn-Tasks").addClass("disabled");
    $("#selectTasks").addClass("disabled");
  } else {
    $("#btn-Tasks").removeClass("disabled");
    $("#selectTasks").removeClass("disabled");
  }

  // status pending => block add
  if (el) this.stat_peding_status = $(el).val();
  if (this.stat_peding_status == "3" || this.isAssignee) {
    $("#btn-Tasks").addClass("disabled");
    $("#selectTasks").addClass("disabled");
  }
};
Tasks.prototype.blockAddTask = function () {
  if (
    this.myuid == 1 ||
    this.myuid == 2 ||
    this.auid == this.myuid ||
    this.pmid == this.myuid
  ) {
    if ($("#id").val()) {
      if ($("#AssignTheApprover").hasClass("disabled"))
        $("#AssignTheApprover").removeClass("disabled");
      if ($("#AssignedTo").hasClass("disabled"))
        $("#AssignedTo").removeClass("disabled");
    }
  } else {
    if ($("#id").val() != "") {
      $("#selectTasks").addClass("disabled");
      var isClosed =
        $(".my-status")
          .closest(".panel-body")
          .find(".group-button")
          .find("[name*=CloseTask]")
          .val() == 0;
      if ($(".my-status").hasClass("disabled") && isClosed)
        $(".my-status").removeClass("disabled");
      $(".block-checkbox").prop("disabled", true);
      $("#RelatedTo").addClass("disabled");
      $("#AssignTheApprover_chosen").addClass("disabled");
    } else {
      if ($("#Status").hasClass("disabled"))
        $("#Status").removeClass("disabled");
    }
    $(".remove-rows-tabs").remove();
  }
};
Tasks.prototype.clickEditTask = function (el) {
  var imt = this.isMytask(el);
  var per = this.checkCasePremission(imt);
  var group = $(el).closest(".group-button");
  var per_full_control = group.data('full_control');
  $(el).remove();
  group.prepend(`
            <button type="button" class="btn btn-alt btn-hover btn-success save-task" title="Click to update task">
                <span>SAVE</span>
                <i class="fa fa-floppy-o" aria-hidden="true"></i>
            </button>
        `);


  if (per == "assignee-approver-my" || per == "approver" || per_full_control) {
    this.enablePanelEditor(group, "right", "notRequired");
    this.enablePanelEditor(group, "left", "notRequired");
    return;
  }

  if (per == "assignee-my") {
    this.enablePanelEditor(group, "right");
    return;
  }

  if (per == "approver") {
    this.enablePanelEditor(group, "left");
    return;
  }
};
Tasks.prototype.enablePanelEditor = function (group, mode, required) {
  if (mode == "left") {
    group.closest(".panel-body").find("[name*=Status]").removeClass("disabled");
    var from_approver = group
      .closest(".panel.panel-default")
      .find(".form-left");
    from_approver.find(".disabled").each(function () {
      $(this).removeClass("disabled");
    });

    // remove title suggest
    from_approver.find(".suggest-edit-title").attr("title", "");
  }

  if (mode == "right") {
    var from_assignee = group
      .closest(".panel.panel-default")
      .find(".form-right");
    from_assignee.find(".disabled").each(function () {
      $(this).removeClass("disabled");
      $(this).removeAttr("disabled");
      if (!$(this).hasClass("my-auto")) {
        if (required != "notRequired") {
          $(this).attr("data-required", "1");
        }
      }
    });

    // remove title suggest
    from_assignee.find(".suggest-edit-title").attr("title", "");
  }
};
Tasks.prototype.toggleDisplayEditbtn = function (el) {
  var isCheck = $(el).val();
  console.log({ isCheck });
  var editBtn = $(el).closest(".group-button").find(".edit-task");
  if (isCheck == "1") {
    editBtn.css("visibility", "hidden");
  } else {
    editBtn.css("visibility", "visible");
  }
};
Tasks.prototype.create_name_input = function (panel) {
  //add_new
  var stt = panel.find(".stt-name").text();
  panel.find(":input").each(function () {
    var n = $(this).data("name");
    if (!!n) {
      var myname = "task[" + stt + "][" + n + "]";
      $(this).attr("name", myname);
    }
  });
};
Tasks.prototype.reload_addNew = function () {
  var _this = this;
  //trigger date
  this.addDatePicker();

  //$('.updatedselect').chosen();
  //textare
  $("textarea").css("overflow", "hidden").autogrow();

  $(".mynamestatus").change(function () {
    var color = $("option:selected", this).attr("style");
    if (!color) {
      $(this).attr("style", " ");
    } else {
      color = color.replace("background-color:#fff;", "");
      $(this).attr(
        "style",
        color.replace("color", "background-color") + ";color:#fff;"
      );
    }
  });
  _this.updateNo();
};
Tasks.prototype.updateNo = function () {
  var stt = $(".stt-name").length;
  $(".stt-name").each(function () {
    $(this).text(stt);
    stt--;
  });
};
Tasks.prototype.clickAllClose = function (el) {
  var ck = $(el).is(":checked");
  $(el).attr("checked", ck);
  $(el).val(ck);

  this.getStateAddSelectTask();

  // if (ck) {
  //     $('#btn-Tasks').addClass('disabled');
  //     $('#selectTasks').addClass('disabled');
  // } else {
  //     $('#btn-Tasks').removeClass('disabled');
  //     $('#selectTasks').removeClass('disabled');
  // }

  this.root.find(".custom-checkbox").each(function () {
    if (!$(this).hasClass("block-is-checked")) {
      $(this).prop("checked", ck);
      $(this).val(ck ? 1 : 0);
    }
  });
  this.root.find(".block-status-checkbox").each(function () {
    if (!$(this).hasClass("block-is-checked")) {
      $(this).prop("checked", ck);
      $(this).val(ck ? 1 : 0);
    }
  });
};

Tasks.prototype.removeFileAttachment = function (el) {
  var _this = this;
  var file = $(el).next().val();
  var att = $(el)
    .closest(".wrapper-file")
    .find('[name*="Attachments"]')
    .serializeArray();
  var attachmentWrap = $(el).parent();
  $.ajax({
    url: site_url + "ajax/ajax_delete_attachment",
    type: "POST",
    cache: false,
    data: {
      id: $("#id").val(),
      dir: _this.dir,
      file: file,
      att: att,
      table: "tasks",
    },
    success: function () {
      attachmentWrap.fadeOut(function () {
        $(this).remove();
      });
    },
  });
};

$(document).ready(function () {
  try {
    var {
      stat_peding_status,
      closeall,
      isadmin,
      currentstt,
      stt,
      userID,
      myuid,
      pmid,
      auid,
      userLevel,
      oldColor,
      currentApprover,
      isAssignee,
    } = JSON.parse($("#params").val());

    var dir = $("#path-dir").data("dir") + $("#code").val();

    var tasks = new Tasks({
      userID,
      auid,
      stt,
      isadmin,
      pmid,
      myuid,
      closeall,
      currentstt,
      oldColor,
      stat_peding_status,
      currentApprover,
      userLevel,
      dir,
      isAssignee,
    });

    tasks.addEventListenner();
  } catch (error) {
    console.log(error);
  }

  $(".sendmail").click(function () {
    $.ajax({
      type: "POST",
      url: "tasks/opensendmail",
      data: {
        id: $('[name="id"]').val(),
      },
      success: function (output) {
        $("#ModalsendMail").html(output).modal("show");
      },
      error: function () {
        alert("Error");
      },
    });
  });

  $(function () {
    var count_total = $("#sortable").find(".stt-name").length;
    var count_late = $(".add-new-task-tab").find(
      "#statusSubtask .btn-danger"
    ).length;
    var count_ontime = $(".add-new-task-tab").find(
      "#statusSubtask .btn-success"
    ).length;
    $("#totalSubtask").val(count_total);
    $("#totalSubtasklate").val(count_late);
    $("#totalSubtaskOntime").val(count_ontime);
  });
});
