<?php 

require("mysql_connect_notes.php");

	//get the notes from the db
	$note_fetch_query = "SELECT * FROM notes";
	$notes = fetch_all($note_fetch_query);
	
foreach ($notes as $note) 
{
	?>
	<div class='postit'>
		<form class='note_edit' action='php/process_note.php' method='post'>
			<fieldset>
				<textarea class='textarea' rows='4' name='note' placeholder= <?= "'{$note["note"]}'"; ?> ></textarea>
				<input type="hidden" name="id" value= <?= "'{$note["id"]}'"; ?> >
				<input type="hidden" name="action" value="edit">
				<button type='submit' class='btn'>Edit</button>
			</fieldset>
		</form>
		<form class='note_delete' action='php/process_note.php' method='post'>
			<fieldset>
				<input type="hidden" name="id" value= <?= "'{$note["id"]}'"; ?> >
				<input type="hidden" name="action" value="delete">
				<button type='submit' class='btn'>Delete</button>
			</fieldset>			
		</form>
	</div>
	<?php
}

?>