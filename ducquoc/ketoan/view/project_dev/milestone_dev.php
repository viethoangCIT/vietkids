<?php
    /**
     * FUNCTION HEADER
     */
    echo $this->Template->load_function_header("QUẢN LÝ MỐC GIAI ĐOẠN DỰ ÁN");

    //thêm phần tử mảng với id rỗng, value = '...' vào $arr_project
    array_unshift($arr_project,array("id"=>"","value"=>"chọn dự án..."));

    /**
     * FORM
     */
    $str_form = "";

    $str_btn_search = $this->Template->load_button(array('type'=>'button',"id"=>"search",'style'=>'width:70px'),'Tìm');
    $str_btn_add_milestone = $this->Template->load_button(array('type'=>'button',"id"=>"add_milestone",'style'=>'width:70px'),'Nhập');
    $str_date = $this->Template->load_label("Từ ngày: ","","search_list");
    $str_date .= $this->Template->load_textbox(array("name"=>"denngay","id"=>"tungay","style"=>"width:15%"));
    $str_date .= $this->Template->load_label("Đến ngày: ","","search_list");
    $str_date .= $this->Template->load_textbox(array("name"=>"tungay","id"=>"denngay","style"=>"width:15%"));
    $str_form = $this->Template->load_label("Dự án: ","","search_list");
    $str_form .= $this->Template->load_selectbox(array("name"=>"data[id_project]","id"=>"id_project","style"=>"width:25%"),$arr_project).$str_date.$str_btn_search.$str_btn_add_milestone;

    $str_form .= "<div id='get_project' style='display:none;'>";
    $str_form .= $this->Template->load_hidden(array("name"=>"data[id]","id"=>"id_milestone"));
    $str_form .= $this->Template->load_form_row(array("title"=>"Tên giai đoạn","input"=>$this->Template->load_textbox(array("name"=>"data[name]","id"=>"name","style"=>"width:40%")) ));
    $str_form .= $this->Template->load_form_row(array("title"=>"Ngày bắt đầu dự kiến","input"=>$this->Template->load_textbox(array("name"=>"data[start]","id"=>"start","style"=>"width:20%")) ));
    $str_form .= $this->Template->load_form_row(array("title"=>"Ngày kết thúc dự kiến","input"=>$this->Template->load_textbox(array("name"=>"data[finish]","id"=>"finish","style"=>"width:20%")) ));
    $str_form .= $this->Template->load_form_row(array("title"=>"Ngày bắt đầu thực tế","input"=>$this->Template->load_textbox(array("name"=>"data[start_actual]","id"=>"start_actual","style"=>"width:20%")) ));
    $str_form .= $this->Template->load_form_row(array("title"=>"Ngày kết thúc thực tế","input"=>$this->Template->load_textbox(array("name"=>"data[finish_actual]","id"=>"finish_actual","style"=>"width:20%")) ));
    $str_form .= $this->Template->load_form_row(array("title"=>"Mô tả","input"=>$this->Template->load_textarea(array("name"=>"data[desc]","id"=>"desc","style"=>"width:40%")) ));
    $str_form .= $this->Template->load_form_row(array("title"=>"","input"=>$this->Template->load_button(array('type'=>'button',"id"=>"save",'style'=>'width:100px'),'Lưu') ));
    $str_form .= "</div>";
    $str_form .= "<hr>";
    $str_form .= "<div id='view_ajax' style='display:none;'>";
    $str_form .= "</div>";
    $str_form = $this->Template->load_form(array("method"=>"GET","action"=>"","id"=>"form_add"),$str_form);
    echo $str_form;
?>
<script type="text/javascript">
    window.view();
    function delete_milestone(id_milestone)
    {
        id_project = $("#id_project").val();
        tungay = $("#tungay").val();
        denngay = $("#denngay").val();


        $.ajax({ method: "GET", url: "/project/milestone",
            data:
            {
                ajax : "delete",
                id_milestone: id_milestone,
            }}).done(function( msg ) {
                view(id_project,tungay,denngay);
            });// $.ajax view
    }

    function edit_milestone(id_milestone)
    {
        $("#get_project").show();
        name = $("#name_"+id_milestone).html();
        start = $("#start_"+id_milestone).html();
        finish = $("#finish_"+id_milestone).html();
        start_actual = $("#start_actual_"+id_milestone).html();
        finish_actual = $("#finish_actual_"+id_milestone).html();
        desc = $("#desc_"+id_milestone).html();

        $( "#id_milestone" ).val(id_milestone);
        $( "#name" ).val(name);
        $( "#start" ).val(start);
        $( "#finish" ).val(finish);
        $( "#start_actual" ).val(start_actual);
        $( "#finish_actual" ).val(finish_actual);
        $( "#desc" ).val(desc);
    }

    function view(id_project,tungay,denngay)
    {
        $.ajax({ method: "GET", url: "/project/milestone",
        data:
        {
            ajax : "view",
            id_project: id_project,
            tungay: tungay,
            denngay: denngay,
        }}).done(function( msg ) {
            $("#view_ajax").show();
            $("#view_ajax").html(msg);
        });// $.ajax view
    }//function view(id_project)

    $(document).ready(function(){
        $( "#tungay" ).datepicker({dateFormat: "dd-mm-yy"});
        $( "#denngay" ).datepicker({dateFormat: "dd-mm-yy"});
        $( "#start" ).datepicker({dateFormat: "dd-mm-yy"});
        $( "#finish" ).datepicker({dateFormat: "dd-mm-yy"});
        $( "#start_actual" ).datepicker({dateFormat: "dd-mm-yy"});
        $( "#finish_actual" ).datepicker({dateFormat: "dd-mm-yy"});

        $("#save").click(function() {
            id_project = $("#id_project").val();
            tungay = $("#tungay").val();
            denngay = $("#denngay").val();
            var str_form = $("#form_add").serialize();
            $.ajax({ method: "GET", url: "/project/milestone?"+str_form,
            data:
            {
                ajax : "save",
            }}).done(function( msg ) {
                $("#get_project").hide();
                view(id_project,tungay,denngay);
            });// $.ajax save
        });//$("#save").click(function() {

        $("#add_milestone").click(function(){
            id_project = $("#id_project").val();
            tungay = $("#tungay").val();
            denngay = $("#denngay").val();
            if (id_project != ""){
                $("#get_project").show();
                $( "#name" ).val("");
                $( "#start" ).val("");
                $( "#finish" ).val("");
                $( "#desc" ).val("");
                $( "#id_milestone" ).val("");
                view(id_project,tungay,denngay);
            }
            else
                {
                    $("#get_project").hide();
                }
         });// $("#id_project").change(function()

        $("#search").click(function(){
            id_project = $("#id_project").val();
            tungay = $("#tungay").val();
            denngay = $("#denngay").val();
            $("#get_project").hide();
            view(id_project,tungay,denngay);
         });// $("#id_project").change(function()
        })
</script>