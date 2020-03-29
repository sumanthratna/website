{include file='header.tpl' page='admin'}
<div id="sratna-contact">
    <div class="container">
        <p><center><a href="logout.php" type="submit" class="btn btn-primary">Logout of Admin Panel</a></center></p>
        <p>
            <center id='message'>
                <?php if (!empty($message)): ?>
                    <?php echo $message; ?>
                <?php endif; ?>
            </center>
        </p>

        <div class="panel-group" id="accordion">
            <?php
                function load_index()
                {
                    header('Content-Type: application/json');
                    echo file_get_contents('../index.json');
                }
            ?>
            <script>
                function refreshJSONeditor() {
                    var editor = ace.edit("jsoneditor");
                    editor.getSession().setValue(JSON.stringify(<?php load_index(); ?>, null, 4), -1);
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
			            <form action="" method="post">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name">Name: </label><input name="create[0]" id="name" type="text" class="form-control" placeholder="Hello World" style="background-color:#fafafa;">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="id">ID: </label><input name="create[1]" id="id" type="text" class="form-control" placeholder="hello-world" style="background-color:#fafafa;">
                                        <script>
                                            $("#name").on('input', function() {
                                                if ($("#name")) {
                                                    $("#id").attr("placeholder", $("#name").val().toLowerCase().replace(new RegExp("\\s+",'g'),"-").replace(new RegExp("[^0-9a-z\-]",'g'),"")).val("").focus().blur();
                                                    $("#name").focus();
                                                }
                                                if ($("#name").val()==="") {
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
                                        <?php $date = getdate(); ?>
                                        <label>Date: </label><input name="create[2]" type="date" class="form-control" value="<?php echo(date('Y-m-d')); ?>" style="background-color:#fafafa;">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="excerpt">Excerpt: </label><input name="create[3]" type="text" class="form-control" placeholder="This is my greeting to the world." style="background-color:#fafafa;">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input name="submitcreate" type="submit" value="Create Post" class="btn btn-primary">
                                    </div>
                                </div>
                            </div>
                        </form>
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
                        <script src="<?php echo $domain ?>/js/jquery-ui.min.js"></script>
                        <link rel="stylesheet" href="<?php echo $domain ?>/css/jquery-ui.min.css">
                        <ul id="sortable" class="list-group">
                            <?php
                                foreach (posts() as $key=>$value) {
                                    echo "<li class=\"ui-state-default list-group-item\" id=\"sortable-$key\">${value['title']}</li>";
                                }
                            ?>
                        </ul>
                        <script>
                            function updateOrder() {
                                var ids = [];
                                for (let listItem of document.getElementById("sortable").children) {
                                    ids.push(listItem.id.replace('sortable-', ''));
                                }
                                $.post('manage.php', {'organize': JSON.stringify(ids, null, 4)}).done(function() {
                                    refreshJSONeditor();
                                    $('#message').fadeOut(0, function() {
                                        $('#message').text('Successfully updated order of posts.').fadeIn(1000);
                                    });
                                });
                            }
                        </script>
                        <input name="submitorganize" type="submit" value="Update Order of Posts" class="btn btn-primary" onclick="updateOrder()">
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
                            editor.setOptions({
                               fontFamily: "Monospace",
                               fontSize: "16pt",
                               autoScrollEditorIntoView: true,
                               enableBasicAutocompletion: true,
                               highlightSelectedWord: true,
                               maxLines: Infinity
                            });
                            editor.on("change", function(e) {
                                $('#savestatus').css('border', '1px solid red');
                            });
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
                                        $.post(window.location, {'edit': JSON.stringify(JSON.parse(editor.getValue()), null, 4)});
                                        $('#savestatus').css('border', '1px solid green');
                                        $('#message').fadeOut(0, function() {
                                            $('#message').text('Successfully saved JSON.').fadeIn(1000);
                                        });
                                    }
                                    else {
                                        $('#message').fadeOut(0, function() {
                                            $('#message').text('Please fix the errors in the JSON before saving.').fadeIn(1000);
                                        });
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
