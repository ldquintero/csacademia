<form id="frm" action="" method="POST">
    <div class="container container-first">
        <div class="title-bar">
            <div id="msgFeedback" class="feedback top">
            </div>
            <h1><?php echo $title; ?></h1>
        </div>
        <div class="row">
            <div class="span3">
                <legend>
                    <?php echo $subject; ?>
                    <div class="btn-toolbar pull-right">
                        <button class="btn btn-small pull-right" data-bind="click: newContact <?php // , visible: echo $editMode    ?>">
                            <i class="icon-plus-sign"></i> <?php echo lang('btn_new'); ?>
                        </button>
                    </div>
                </legend>
                <div class="row-fluid">            
                    <input id="appendedInputButtons" type="text" class="span*" placeholder="<?php echo lang('form_type_filter'); ?>"
                           data-bind="value: filter">
                </div>
                <table id="tblContacts" class="table table-bordered table-hover table-condensed table-striped cursor-pointer">
                    <thead>
                        <tr>
                            <th><?php echo lang('form_name'); ?></th>
                        </tr>
                    </thead>            
                    <tbody data-bind="foreach: filteredContacts">
                        <tr data-bind="click: $root.selectContact">
                            <td data-bind="text: full_name()"></td>
                        </tr>
                    </tbody>
                </table>
                <?php
                if (isset($filter_panel)) {
                    $this->load->view($filter_panel);
                }
                ?>
            </div>
            <div class="span9">
                <legend data-bind="with: currentContact">
                    <span class="title-item-select" data-bind="text: full_name() + '&nbsp;'"></span>
                    <div class="pull-right">
                        <button class="btn btn-small btn-success" data-bind="click: $root.saveContact">
                            <i class="icon-ok-sign icon-white"></i> <?php echo lang('btn_save'); ?>
                        </button>
                        <button class="btn btn-small btn-danger" data-bind="click: $root.removeContact">
                            <i class="icon-minus-sign icon-white"></i> <?php echo lang('btn_delete'); ?>
                        </button>
                        <?php
                        $page = $this->uri->segment(2);
                        if ($page == 'teacher') {
                            $print = '$root.printTeachers';
                        } elseif ($page == 'student') {
                            $print = '$root.printStudents';
                        } else {
                            $print = '$root.printContacts';
                        }
                        ?>
                        <button type="button" class="btn btn-small " data-target="_blank" 
                                data-bind="click: <?php echo $print ?>">
                            <i class="icon-print"></i> <?php echo lang('btn_print'); ?>
                        </button>
                    </div>
                </legend>
                <ul id="tbContactData" class="nav nav-tabs">
                    <li class="active"><a href="#generalData" data-bind="click: $root.activateTab"><?php echo lang('subject_general_data'); ?></a></li>
                    <?php
                    if (isset($extra_tabs)) {
                        $this->load->view($extra_tabs);
                    }
                    ?>
                </ul>
                <div class="tab-content">
                    <div id="generalData" class="tab-pane active" data-bind="with: currentContact">
                        <?php
                        $data = [
                            'pictureDialogId' => isset($pictureDialogId) ? $pictureDialogId : 'currentContactPicture',
                            'pictureDialogBind' => isset($pictureDialogBind) ? $pictureDialogBind : '$root.currentContact'
                        ];
                        $this->load->view('manager/contact_admin_contact_data', $data);
                        ?>
                    </div>
                    <?php
                    if (isset($extra_tabs_content)) {
                        $this->load->view($extra_tabs_content);
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</form>