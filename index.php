<!DOCTYPE html>
<html lang="en">  
  <head>
    <title>Notes</title>
    <?php 	include("php/header.php");     ?>
  </head>
  <body>
  	<div class="span6" id="my_container">
		<!-- The form below creates a new note -->
		<div class="postit">
			<form id="note_form" action="php/process_note.php" method="post">
				<fieldset>
					<textarea id="textarea" rows="4" name="note" placeholder="Add a note"></textarea>
					<input type="hidden" name="action" value="add">
					<button type="submit" class="btn">Add</button>
				</fieldset>
			</form>
		</div>
		<!-- This displays the existing postits -->
  		<?php include("php/display_notes.php") ?>
	</div>
  </body>
</html>