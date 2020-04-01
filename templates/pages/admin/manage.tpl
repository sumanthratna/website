{include file='header.tpl' page='admin'}
<div id="sratna-contact">
    <div class="container">
        <p style="text-align: center;"><a href={'https://'|cat:$smarty.server.HTTP_HOST|cat:'/admin/logout'} type="submit" class="btn btn-primary">Logout of Admin Panel</a></p>
        
        <p style="text-align: center;" id="output-message">&#8203;</p>

        <div class="panel-group" id="accordion">
            <script>
                function refreshJSONeditor() {
                    var editor = ace.edit("jsoneditor")
                    editor.getSession().setValue(JSON.stringify({$posts|@json_encode}, null, 4), -1);
                    editor.renderer.updateFull(true);
                }
                $('#edit').on('show.bs.collapse', function() {
                    var editor = ace.edit("jsoneditor");
                    editor.resize(true);
                });
                $('#edit').on('shown.bs.collapse', function() {
                    var editor = ace.edit("jsoneditor");
                    editor.resize(true);
                });
            </script>
            <div class="panel panel-default">
                <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#create">
                    <h4 class="panel-title">
                        <a href>Create Post</a>
                    </h4>
                </div>
                <div id="create" class="panel-collapse collapse">
                    <div class="panel-body">
			            <form id="create-form" action="admin.php" method="post">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="title">Title: </label><input id="title" type="text" class="form-control" placeholder="Hello World" style="background-color:#fafafa;">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="id">ID: </label><input id="id" type="text" class="form-control" placeholder="hello-world" style="background-color:#fafafa;">
                                        <script>
                                            $("#title").on('input', function() {
                                                if ($("#title")) {
                                                    $("#id").attr("placeholder", $("#title").val().toLowerCase().replace(new RegExp("\\s+",'g'),"-").replace(new RegExp("[^0-9a-z\-]",'g'),"")).val("").focus().blur();
                                                    $("#title").focus();
                                                }
                                                if ($("#title").val()==="") {
                                                    $("#id").attr("placeholder", "hello-world");
                                                }
                                            });
                                            $('#id').on('input', function() {
                                              if ($("#id").val()==="") {
                                                var c = this.selectionStart,
                                                    r = /[^a-z0-9\-]/gi,
                                                    v = $(this).val();
                                                if(r.test(v)) {
                                                  $(this).val(v.replace(r, ''));
                                                  c--;
                                                }
                                                this.setSelectionRange(c, c);
                                              }
                                            });
                                        </script>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="date">Date: </label><input id="date" type="date" class="form-control" value={$smarty.now|date_format:"Y-m-d"} style="background-color:#fafafa;">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="excerpt">Excerpt: </label><input id="excerpt" type="text" class="form-control" placeholder="This is my greeting to the world." style="background-color:#fafafa;">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input name="submit-create" type="submit" value="Create Post" class="btn btn-primary">
                                    </div>
                                </div>
                            </div>
                        </form>
                        <script>
                            $("#create-form").submit(function(event) {

                                /* stop form from submitting normally */
                                event.preventDefault();
                                
                                $("#output-message").fadeOut(function() {
                                  $(this).text('Loading...').fadeIn();
                                });
                                $("#title").prop( "disabled", true );
                                $("#id").prop( "disabled", true );
                                $("#date").prop( "disabled", true );
                                $("#excerpt").prop( "disabled", true );
                                
                                var $manageUrl = '{('https://'|cat:$smarty.server.HTTP_HOST|cat:'/admin.php')|escape:'javascript'}';
                                
                                /* Send the data using post */
                                var $secret = '{$secret|escape:'javascript'}';
                                
                                var $id = $('#id').val();
                                var $title = $('#title').val();
                                if ($id === "") {
                                    $id = $title.toLowerCase().replace(/[[:space:]]+/g, '-').replace('[^0-9a-z\-]', '');
                                }
                                var posting = $.post( $manageUrl, { 'create': { title: $title, id: $id, date: $("#date").val(), excerpt: $("#excerpt").val() }, secret: $secret } );
                                
                                /* Alerts the results */
                                posting.done(function( data ) {
                                    var outputMessage = jQuery.parseJSON(data).message;
                                        $("#output-message").fadeOut(function() {
                                        $(this).text(outputMessage).fadeIn();
                                    });
                                  if (outputMessage.startsWith('Successfully created post')) {
                                        $("#title").val('');
                                        $("#id").val('');
                                        $("#date").val({$smarty.now|date_format:"Y-m-d"});
                                        $("#excerpt").val('');
                                  } else {
                                        $("#title").prop( "disabled", true );
                                        $("#id").prop( "disabled", true );
                                        $("#date").prop( "disabled", true );
                                        $("#excerpt").prop( "disabled", true );
                                  }
                                  $("#submit-create").prop( "disabled", false );
                                });
                            });
                            function updateOrder() {
                                
                                var $manageUrl = '{('https://'|cat:$smarty.server.HTTP_HOST|cat:'/admin.php')|escape:'javascript'}';
                                var $secret = '{$secret|escape:'javascript'}';
                                $.post( $manageUrl, { 'organize': JSON.stringify(ids, null, 4), 'secret': $secret } ).done(function() {
                                    refreshJSONeditor();
                                    $('#output-message').fadeOut(0, function() {
                                        $('#output-message').text('Successfully updated order of posts. Refresh this page to see changes to the footer.').fadeIn(1000);
                                    });
                                });
                            }
                        </script>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#organize">
                    <h4 class="panel-title">
                        <a href>Organize Posts</a>
                    </h4>
                </div>
                <div id="organize" class="panel-collapse collapse">
                    <div class="panel-body">
                        <script src={'https://'|cat:$smarty.server.HTTP_HOST|cat:'/js/jquery-ui.min.js'}></script>
                        <link rel="stylesheet" href={'https://'|cat:$smarty.server.HTTP_HOST|cat:'/css/jquery-ui.min.css'}>
                        <ul id="sortable" class="list-group">
                            {foreach from=$posts key=id item=post}
                                {assign var=post_title value=$post.title}
                                <li class="ui-state-default list-group-item" id={"sortable-"|cat:$id}>{$post_title}</li>
                            {/foreach}
                        </ul>
                        <script>
                            function updateOrder() {
                                var ids = [];
                                for (let listItem of document.getElementById("sortable").children) {
                                    ids.push(listItem.id.replace('sortable-', ''));
                                }
                                var $manageUrl = '{('https://'|cat:$smarty.server.HTTP_HOST|cat:'/admin.php')|escape:'javascript'}';
                                var $secret = '{$secret|escape:'javascript'}';
                                
                                $.post( $manageUrl, { 'organize': JSON.stringify(ids, null, 4), 'secret': $secret } ).done(function() {
                                    refreshJSONeditor();
                                    $('#output-message').fadeOut(0, function() {
                                        $('#output-message').text('Successfully updated order of posts. Refresh this page to see changes to the footer.').fadeIn(1000);
                                    });
                                });
                            }
                        </script>
                        <input name="submit-organize" type="submit" value="Update Order of Posts" class="btn btn-primary" onclick="updateOrder()">
                    </div>
                    <script>
                        $(function() {
                            $('#sortable').sortable();
                            $('#sortable').disableSelection();
                        });
                    </script>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#edit">
                    <h4 class="panel-title">
                        <a href>Manual Configuration</a>
                    </h4>
                </div>
                <div id="edit" class="panel-collapse collapse">
                    <div class="panel-body">
                        <script src="https://cdn.jsdelivr.net/ace/1.2.6/noconflict/ace.js" type="text/javascript" charset="utf-8"></script>
                        <script src="https://cdn.jsdelivr.net/ace/1.2.6/noconflict/ext-language_tools.js" type="text/javascript" charset="utf-8"></script>
                        <hr id='savestatus'/>
                        <div id="jsoneditor" style="height:400px;font-family:monospace; font-size:12px;"></div>
                        <script>
                            ace.config.set("basePath", "https://cdn.jsdelivr.net/ace/1.2.6/noconflict/");
                            var editor = ace.edit("jsoneditor");
                            editor.setOptions( {
                               fontFamily: "Monospace",
                               fontSize: "16pt",
                               autoScrollEditorIntoView: true,
                               enableBasicAutocompletion: true,
                               highlightSelectedWord: true,
                               maxLines: Infinity
                            } );
                            editor.on("change", function(e) {
                                $('#savestatus').css('border', '1px solid red');
                            } );
                            editor.commands.addCommand({
                                name: 'saveFile',
                                bindKey: {
                                    win: 'Ctrl-S',
                                    mac: 'Command-S',
                                    sender: 'editor|cli'
                                },
                                exec: function(env, args, request) {
                                    if (editor.getSession().getAnnotations().length==0) {
                                        $('#invalidjson').fadeOut(1000, function() {});
                                        
                                        var $manageUrl = '{('https://'|cat:$smarty.server.HTTP_HOST|cat:'/admin.php')|escape:'javascript'}';
                                        var $secret = '{$secret|escape:'javascript'}';
                                        
                                        $.post($manageUrl, { 'edit': JSON.stringify(JSON.parse(editor.getValue()), null, 4), 'secret': $secret });
                                        $('#savestatus').css('border', '1px solid green');
                                        $('#output-message').fadeOut(0, function() {
                                            $('#output-message').text('Successfully saved JSON.').fadeIn(1000);
                                        } );
                                    }
                                    else {
                                        $('#output-message').fadeOut(0, function() {
                                            $('#output-message').text('Please fix the errors in the JSON before saving.').fadeIn(1000);
                                        } );
                                    }
                                }
                            });
                            editor.$blockScrolling = Infinity;
                            editor.getSession().setMode("ace/mode/json");
                            refreshJSONeditor();
                            $('#savestatus').css('border', '1px solid grey');
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{include file='footer.tpl'}
