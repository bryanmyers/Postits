<?php 
require("mysql_connect_notes.php");

if($_POST['action'] == "add")
{
	$sani_note = mysql_real_escape_string($_POST['note']);
	$note_insert_query = "INSERT INTO notes (note) VALUES ('{$sani_note}')";\
	mysql_query($note_insert_query);

	//after adding the note, get it's ID so that it can be added to the form ID now and not after a page reload.
	$last_id_query = "SELECT id FROM notes ORDER BY id DESC LIMIT 1";

	$id = fetch_record($last_id_query);

	$html = "
	<div class='postit'>
		<form class='note_form' action='php/process_note.php' method='post'>
			<fieldset>
				<input type='hidden' name='id' value='{$id['id']}' >
				<input type='hidden' name='action' value='edit'>
				<textarea class='textarea' rows='4' name='note' placeholder='{$_POST['note']}'></textarea>
				<button type='submit' class='btn'>Edit</button>
			</fieldset>
		</form>
		<form class='note_delete' action='php/process_note.php' method='post'>
			<fieldset>
				<input type='hidden' name='id' value='{$id['id']}'>
				<input type='hidden' name='action' value='delete'>
				<button type='submit' class='btn'>Delete</button>
			</fieldset>			
		</form>
	</div>
	";
	echo json_encode($html);
}
if($_POST['action'] == "edit")
{
	$sani_note = mysql_real_escape_string($_POST['note']);
	$note_edit_query = "UPDATE notes SET note='{$sani_note}' WHERE id='{$_POST['id']}'";

	mysql_query($note_edit_query);

	$html = "
	<div class='postit'>
		<form class='note_form' action='php/process_note.php' method='post'>
			<fieldset>
				<textarea class='textarea' rows='4' name='note' placeholder='{$sani_note}'></textarea>
				<input type='hidden' name='id' value='{$_POST['id']}'>
				<button type='submit' class='btn'>Edit</button>
			</fieldset>
		</form>
		<form class='note_form' action='php/process_note.php' method='post'>
			<fieldset>
				<input type='hidden' name='id' value='{$_POST['id']}'>
				<button type='submit' class='btn'>Delete</button>
			</fieldset>			
		</form>
	</div>
	";
	echo json_encode($html);
}


if($_POST['action'] == "delete")
{


	$note_delete_query = "DELETE FROM notes WHERE id='{$_POST['id']}'";

	mysql_query($note_delete_query);

	// //this is only in there because the code below was inexplicably not working.  it would literally just put up the text "something" and not go back to the index.
	// header("Location: ../index.php");

	$something = "something";

	//in the future figure out how to trigger this only if the query succeeds.
	echo json_encode($something);
}
?>