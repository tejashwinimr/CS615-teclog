<?php
require_once "lib/Smarty.class.php";
require_once "database.php";

if(isset($_COOKIE['ACTIVE_NOTE_ID'])) {
    if(!isValid($_COOKIE['ACTIVE_NOTE_ID'])) {
        setcookie("ACTIVE_NOTE_ID", getMaxId());
        $activeNoteId = getMaxId();
    } else {
        $activeNoteId = $_COOKIE['ACTIVE_NOTE_ID'];
    }
}

if(isset($_REQUEST['action'])) {
    switch($_REQUEST['action']) {
        case 'delete':
            deleteNote($activeNoteId);
            $newId = getMaxId();
            setcookie("ACTIVE_NOTE_ID", $newId);
            $activeNoteId = $newId;
            break;
        case 'update':
            updateNote($_COOKIE['ACTIVE_NOTE_ID'], $_REQUEST['content']);
            break;
        case 'new':
            createNote("New note.");
            $newId = getMaxId();
            setcookie("ACTIVE_NOTE_ID", $newId);
            $activeNoteId = $newId;
            break;
        case 'navigate':
            setcookie("ACTIVE_NOTE_ID", $_REQUEST['id']);
            $activeNoteId = $_REQUEST['id'];
            break;
    }
}

$template = new Smarty();

if(isset($activeNoteId))
    $template->assign("ACTIVE_NOTE_ID", $activeNoteId);
$template->assign("notes", getNotes());
$template->display('index.tpl');
?>