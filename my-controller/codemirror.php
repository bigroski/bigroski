<link rel="stylesheet" href="codemirror/lib/codemirror.css">
<script src="codemirror/lib/codemirror.js"></script>
<script src="codemirror/addon/edit/matchbrackets.js"></script>
<script src="codemirror/mode/htmlmixed/htmlmixed.js"></script>
<script src="codemirror/mode/xml/xml.js"></script>
<script src="codemirror/mode/javascript/javascript.js"></script>
<script src="codemirror/mode/css/css.js"></script>
<script src="codemirror/mode/clike/clike.js"></script>
<script src="codemirror/mode/php/php.js"></script>
<?php 
   $content = (file_get_contents('index.php'));
    
?>
    

<form><textarea id="code" name="code">
<?php echo $content; ?>
</textarea></form>

    <script>
      var editor = CodeMirror.fromTextArea(document.getElementById("code"), {
        lineNumbers: true,
        matchBrackets: true,
        mode: "application/x-httpd-php",
        indentUnit: 4,
        indentWithTabs: true,
        enterMode: "keep",
        tabMode: "shift"
      });
    </script>