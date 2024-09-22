<?php if ($GLOBALS['user']['level'] == 1 || $GLOBALS['per']['full']) : ?>
    <style>
        .display-part {
            margin-top: 5px;
        }
        .tableFloatingHeaderOriginal tr th {
            background: #ddd;
            vertical-align: middle;
        }
        .fullsceen-modal .modal-body {
            top: 43px;
        }
    </style>
    <div class="group-process">
        <?php if (isset($export)) : ?>
            <?php if (count($export) > 0) : ?>
                <div class="dropdown">
                    <button type="button" class="btn btn-border btn-alt border-black font-black waves-effect dropdown-toggle" title="Export to Excel" data-toggle="dropdown"><i class="glyph-icon icon-download"></i></button>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <?php foreach ($export as $key => $val) : ?>
                            <?php if ($key === 'EXCEL' && (empty($val) || $val == '#')) : ?>
                                <li class="dropdown-item"><a class="exports-part-file" href="javascript:;" data-placement="bottom" title="Exports"><?= $key ?></a></li>
                            <?php else : ?>
                                <li class="dropdown-item"><a target="_blank" href="<?= $val ?>"><?= $key ?></a></li>
                            <?php endif ?>
                        <?php endforeach ?>
                    </ul>
                </div>
            <?php else : ?>
                <a class="btn btn-border btn-alt border-blue font-blue tooltip-link exports-part-file" href="javascript:;" data-href="modules/export/<?= $modulePart ?>" data-placement="bottom" title="Exports"><i class="glyph-icon icon-download"></i></a>
            <?php endif ?>
        <?php endif ?>
        <?php if ($display) : ?>
            <a class="btn btn-border btn-alt border-purple font-purple tooltip-link part-show-hide" href="javascript:;" data-placement="bottom" title="Display">
                <i class="glyph-icon icon-th-list"></i>
            </a>
        <?php endif ?>
    </div>
    <?php if ($display) : ?>
        <component class="display-part" is-ajax data-ajax="<?= @$ajax ?>" data-modulePart="<?= @$modulePart ?>" data-module="<?= @$module ?>" data-field="<?= @$field ?>" data-return="html"></component>
    <?php endif ?>
    <script>
        var option_display = <?= isset($display) ? 1 : 0 ?>,
            option_export = <?= isset($export) ? 1 : 0 ?>,
            modulePart = '<?= $modulePart ?>',
            module = '<?= @$module ?>';
        /* Display Config Part */
        class displayPart {
            constructor() {
                this.init();
                this.root = $("body");
                this.bindFunction();
            }
        }
        displayPart.prototype.init = async function() {}
        displayPart.prototype.bindFunction = function() {
            var app = this;
            this.root.on("click", ".part-show-hide", async function() {
                await app.partDisplayOptions();
            }).on("submit", "#colsModal form.part-main-form", async function(e) {
                await app.submitPartDisplayOptions();
            }).on('click', '#colsModal form.part-main-form .field-group', function() {
                $('#colsModal form.part-main-form .field-group').prop('checked', false);
                $(this).prop('checked', true);
            }).on('change', '.field-show', async function() {
                await app.handelFieldShow($(this));
            });
        }
        displayPart.prototype.handelFieldShow = (ele) => {
            var tab = ele.parents('.tab-pane').attr('id'),
                line = 1,
                name = ele.data('key'),
                value = ele.is(":checked") ? 1 : 0;
            if (tab === 'line-1') line = 2;
            if (value == 1) {
                $('#line-' + line).find('input[name="part_options[' + line + '][' + name + '][show]"].field-show').parents('tr').hide();
            } else {
                $('#line-' + line).find('input[name="part_options[' + line + '][' + name + '][show]"].field-show').parents('tr').show();
            }
        }
        displayPart.prototype.submitPartDisplayOptions = async function() {
            var serializedData = $('#colsModal form.part-main-form').serialize();
            var deserializeData = this.deserializeParams(serializedData);
            var data = this.deleteData(deserializeData);
            var res = await this.send({
                part_options: data,
                modulePart: modulePart
            }, 'update_cols_part/' + module);
            if (res) {
                window.location = window.location;
            }
        }
        displayPart.prototype.deleteData = function(obj) {
            var result = {};
            for (var key in obj) {
                for (var k in obj[key]) {
                    if ((typeof obj[key][k]['show'] != 'undefined' && obj[key][k]['show'] === '1')) {
                        obj[key][k]['name'] = obj[key][k]['name'].replace(/\+/g, ' ');
                        result[k] = obj[key][k];
                    }
                }
            }
            return result;
        }
        displayPart.prototype.deserializeParams = (params) => {
            var obj = {};
            var splitParams = params.split('&');
            splitParams.forEach(function(param) {
                var keyValuePair = param.split('=');
                var key = decodeURIComponent(keyValuePair[0]);
                var value = decodeURIComponent(keyValuePair[1]);
                var nestedKeys = key.match(/\[([^\[\]]+)\]/g);
                var nestedObj = obj;
                nestedKeys.forEach(function(nestedKey, index) {
                    var keyName = nestedKey.replace(/[\[\]]/g, '');
                    var isLastKey = index === nestedKeys.length - 1;
                    if (isLastKey) {
                        if (nestedObj[keyName] !== undefined) {
                            if (!Array.isArray(nestedObj[keyName])) {
                                nestedObj[keyName] = [nestedObj[keyName]];
                            }
                            nestedObj[keyName].push(value);
                        } else {
                            nestedObj[keyName] = value;
                        }
                    } else {
                        if (!nestedObj[keyName]) {
                            nestedObj[keyName] = {};
                        }
                        nestedObj = nestedObj[keyName];
                    }
                });
            });
            return obj;
        }
        displayPart.prototype.partDisplayOptions = async function() {
            var html = await this.send({
                "modulePart": modulePart,
                "module": module
            }, "part_options", {
                html: true
            });
            $('#colsModal .modal-content').html(html);
            const multi_tab = ['po_cpo', 'po_cpo_close'];
            var fo = 43;
            if (multi_tab.includes(modulePart)) {
                fo = 65;
            }
            if ($('#mainTable-module-col').length) {
                this.createDragTasks('mainTable-module-col');
                $('#mainTable-module-col').stickyTableHeaders({
                    fixedOffset: fo,
                    scrollableArea: '.modal-body'
                });
            }
            if ($('#mainTable-module-col2').length) {
                this.createDragTasks('mainTable-module-col2');
                $('#mainTable-module-col2').stickyTableHeaders({
                    fixedOffset: fo,
                    scrollableArea: '.modal-body'
                });
            }
            $('#colsModal').modal('show');
        }
        displayPart.prototype.createDragTasks = function(name) {
            $("#" + name).tableDnD();
        }
        displayPart.prototype.send = function(data, url, option = {}) {
            return new Promise((resolve, reject) => {
                $.ajax({
                    url: "modules/" + url,
                    type: "POST",
                    data: data,
                    beforeSend: function() {
                        showProcess(1);
                        $(".panel.panel-default.panel-sticky").css("pointer-events", "none");
                        $("body").css("cursor", "progress");
                    },
                    complete: function() {
                        hideLoading();
                        $(".panel.panel-default.panel-sticky").css("pointer-events", "auto");
                        $("body").css("cursor", "auto");
                    },
                    success: function(res) {
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
                    error: function(jqXHR, textStatus, errorThrown) {
                        hideLoading();
                        reject({});
                    },
                });
            });
        }
        /* Export Data */
        class ExportPart {
            constructor() {
                this.init();
                this.root = $("body");
                this.bindFunction();
            }
        }
        ExportPart.prototype.init = async function() {}
        ExportPart.prototype.bindFunction = function() {
            var app = this;
            this.root.on("click", ".exports-part-file", async function() {
                $.ajax({
                    url: site_url + 'modules/export_options',
                    type: 'POST',
                    cache: false,
                    data: {
                        table: modulePart,
                        title: 'Exports'
                    },
                    success: function(html) {
                        $('#options-export .modal-content').html(html);
                        $('#options-export').modal('show');
                    }
                });
            });
        }
        if (option_display) new displayPart(document.currentScript.getAttribute('id'));
        if (option_export) new ExportPart(document.currentScript.getAttribute('id'));
    </script>
<?php endif ?>