<?php
/**
 * Comment on a question/answer river view
 */

/*$performed_by = get_entity($vars['item']->subject_guid);
$object = get_entity($vars['item']->object_guid);
$item = $vars['item'];
$timestamp = elgg_view_friendly_time($item->getPostedTime());

$type = $object->getSubType();
$person_url = "<a href=\"{$performed_by->getURL()}\">{$performed_by->name}</a>";

$string = "<div class='elgg-river-summary'>";
$string .= sprintf(elgg_echo("question:river:comment:".$type),$person_url) . " ";
$object_title = $type == 'answer' ? get_question_for_answer($object)->title : $object->title;
$string .= "<a href=\"" . $object->getURL() . "\">" . $object_title . "</a>";
$string .= '<span class="elgg-river-timestamp"> ' . $timestamp . ' </span></div>';


echo elgg_view('page/components/image_block', array(
	'image' => elgg_view('river/elements/image', $vars),
	'body' => $string,
	'class' => 'elgg-river-item',
));*/




$item = $vars['item'];

$comment = get_entity($item->object_guid);
$user = get_entity($comment->getContainerGUID());
$parent = get_entity($comment->getGUID());

$questionurl = "<a href=".$parent->getURL().">".$parent->title."</a>";
$userurl = "<a href=".$user->getURL().">".$user->name."</a>";
$excerpt = elgg_get_excerpt($comment->description);

$summary = sprintf(elgg_echo("question:river:comment:".$parent->getSubtype()), $userurl, $questionurl);

$vars['item']->subject_guid = $user->getGUID();

echo elgg_view('river/elements/layout', array(
	'item' => $item,
	'summary' => $summary,
	'message' => $excerpt,
));
